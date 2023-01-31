<?php

namespace App\Http\Controllers\CallChecklist;

use App\Exports\ShojonCallChecklistExport;
use App\Http\Controllers\Controller;
use App\Models\CallChecklistForShojon;
use App\Models\District;
use App\Models\ShojonMainReasonForCalling;
use App\Models\ShojonMentalIllnessDiagnosis;
use App\Models\ShojonSecondaryReasonForCalling;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use Svg\Tag\Rect;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class ShojonController extends Controller
{
    protected $pageTitle = 'Call Checklist for Shojon';
    protected $monthDuration = 3;


    public function index(Request $request)
    {
        $data = $this->setFilterParams();

        $pageTitle = $this->pageTitle;

        $shojonData = $this->ShojonFilteredData($request, $data);

        // $shojonData = CallChecklistForShojon::whereBetween('created_at', [$data['start'], $data['end']])->get();
        //dd($shojonData);
        //dd($data);

        return view('call_checklist.shojon.index', compact('pageTitle', 'shojonData', 'data'));
    }

    public function create($refId = 0, $phone = '', $new = 0)
    {
        if ($new == 1) {
            dd($new);
        }
        $pageTitle = $this->pageTitle;
        $previous_data = null;
        $last = null;

        try {
            $is_phone_no = CallChecklistForShojon::where('phone_number', $phone)->first();
            if ($is_phone_no) {
                $previous_data = CallChecklistForShojon::where('phone_number', $phone)->get();
                $last = $previous_data->last();
            }

            $districts = District::orderBy('name')->pluck('name');
            $main_reason = ShojonMainReasonForCalling::all()->pluck('reason');
            $secondary_reason = ShojonSecondaryReasonForCalling::all()->pluck('reason');
            $mental_illness = ShojonMentalIllnessDiagnosis::all()->pluck('illness');

            return view('call_checklist.shojon.create', compact('pageTitle', 'districts', 'main_reason', 'secondary_reason', 'mental_illness', 'refId', 'phone', 'is_phone_no', 'previous_data', 'last'));
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'referrence_id' => 'required',
        //     'phone_number' => 'required',
        //     'sex' => 'required',
        //     'age' => 'required',
        //     'occupation' => 'required',
        //     'location' => 'required',
        //     'hearing_source' => 'required',
        //     'call_type' => 'required',
        //     'caller' => 'required',
        //     'main_reason_for_calling' => 'required',
        //     'secondary_reason_for_calling' => 'required',
        //     'mental_illness_diagnosis' => 'required',
        //     'ghq' => 'required',
        //     'call_effectivenes' => 'required',
        //     'client_referral' => 'required',
        //     'caller_description' => 'required',
        // ]);

        if ($request->message) {
            $this->sendSms($request->message, $request->phone_number);
        }

        // $params = $request->except('_token');

        // if ($params['occupation'] == "on") {
        //     $params['occupation'] = $params['other_occupation'];
        // }
        // if ($params['hearing_source'] == "on") {
        //     $params['hearing_source'] = $params['other_hearing_source'];
        // }
        // if ($params['main_reason_for_calling'] == "on") {
        //     $params['main_reason_for_calling'] = $params['other_main_reason_for_calling'];
        // }
        // if($params['secondary_reason_for_calling']==null)
        // {

        // }
        // elseif ($params['secondary_reason_for_calling'] == "on") {
        //     $params['secondary_reason_for_calling'] = $params['other_secondary_reason_for_calling'];
        // } elseif ($params['other_secondary_reason_for_calling'][0] != null) {
        //     $params['secondary_reason_for_calling'] = array_merge($params['secondary_reason_for_calling'], $params['other_secondary_reason_for_calling']);
        // }
        // if ($params['mental_illness_diagnosis'] == "on") {
        //     $params['mental_illness_diagnosis'] = $params['other_mental_illness_diagnosis'];
        // } elseif ($params['mental_illness_diagnosis'][0] != null) {
        //     $params['mental_illness_diagnosis'] = array_merge($params['mental_illness_diagnosis'], $params['other_mental_illness_diagnosis']);
        // }
        // if ($params['client_referral'] == "on") {
        //     $params['client_referral'] = $params['other_client_referral'];
        // }
        $data = [
            'referrence_id' => $request['referrence_id'],
            'phone_number' => $request['phone_number'],
            'agent' => (auth()->user() != null) ? auth()->user()->user : "vicidia",
            'caller_name' => isset($request['caller_name']) ? $request['caller_name'] : null,
            'caller_id' => 1,
            'sex' => $request['sex'],
            'age' => $request['age'],
            'occupation' => $request['occupation'],
            'socio_economic_status' => isset($request['socio_economic_status']) ? $request['socio_economic_status'] : null,
            'location' => $request['location'],
            'hearing_source' => $request['hearing_source'],
            'call_type' => $request['call_type'],
            'caller' => $request['caller'],
            'pre_mood_rating' => $request['pre_mood_rating'],
            'main_reason_for_calling' => $request['main_reason_for_calling'],
            'secondary_reason_for_calling' => implode("; ", $request['secondary_reason_for_calling']),
            'mental_illness_diagnosis' => implode("; ", $request['mental_illness_diagnosis']),
            'ghq' => $request['ghq'],
            'suicidal_risk' => isset($request['suicidal_risk']) ? $request['suicidal_risk'] : null,
            'post_mood_rating' => $request['post_mood_rating'],
            'call_effectivenes' => $request['call_effectivenes'],
            'client_referral' => $request['client_referral'],
            'caller_description' => $request['caller_description'],
            'ref_client_name' => $request['ref_client_name'] ? $request['ref_client_name'] : null,
            'ref_age' => $request['ref_age'] ? $request['ref_age'] : null,
            'ref_therapy_reason' => $request['ref_therapy_reason'] ? $request['ref_therapy_reason'] : null,
            'ref_phone_number' => $request['ref_phone_number'] ? $request['ref_phone_number'] : null,
            'ref_preferred_time' => $request['ref_preferred_time'] ? $request['ref_preferred_time'] : null,
            'ref_emergency_number' => $request['ref_emergency_number'] ? $request['ref_emergency_number'] : null,
            'ref_financial_affort' => $request['ref_financial_affort'] ? $request['ref_financial_affort'] : null,
            'ref_therapist_preference' => $request['ref_therapist_preference'] ? $request['ref_therapist_preference'] : null,
            'created_by' => auth()->id(),
            'updated_by' => Carbon::now()
        ];


        $phone = $request->phone_number;

        // $is_phone_no = CallChecklistForShojon::where('phone_number', $phone)->first();
        $is_phone_no = CallChecklistForShojon::where('phone_number', $phone)->first();
        if ($is_phone_no != NULL) {
            session()->flash('success', 'Added successfully !!');
        } else {
            $patient = new Patient;

            $patient->name = $request->caller_name;
            $patient->phone_number = $request->phone_number;
            $patient->caller_id = $request->caller_id;
            $patient->sex = $request->sex;
            $patient->age = $request->age;
            $patient->occupation = $request->occupation;
            $patient->location = $request->location;
            $patient->socio_economic_status = $request->socio_economic_status;
            $patient->hearing_source = $request->hearing_source;
            $patient->caller_description = $request->caller_description;
            $patient->unique_id = rand(100000, 999999);
            $patient->created_by = auth()->id();
            $patient->created_at = Carbon::now();
            $patient->save();
            session()->flash('success', 'Added successfully & New Client Created!!');
        }

        // $status = 'Checklist for Shojon created successfully';
        CallChecklistForShojon::create($data);

        return redirect(route('call_checklist.shojon.index'));
    }

    private function sendSms($message, $phone)
    {
        $url = "http://172.16.252.91/smsapi";
        $data = [
            "api_key" => "C200111761581ef3d46af1.78303603",
            "type" => "text",
            "contacts" => $phone,
            "senderid" => "8809612119900",
            "msg" => $message,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    protected function setFilterParams(Request $request = null)
    {
        $request = $request ?: request();

        $data['start'] = $request->start ? Carbon::parse($request->start) : Carbon::now()->subMonths($this->monthDuration);
        $data['end'] = $request->end ? Carbon::parse($request->end . " 23:59:59") : Carbon::now();

        $data['sex'] = ['Male', 'Female', 'Intersex', 'Others'];
        $data['age'] = ['0-12', '13-19', '20-30', '31-40', '41-65', '65+', 'Do not know', 'Do not want to share'];
        $data['occupation'] = ['Student', 'Job holder', 'Businessperson', 'Housewife', 'Unemployed', 'Retired', 'Could not tell'];
        $data['socio_economic_status'] = ['Upper', 'Upper Middle Class', 'Middle Class', 'Lower Middle Class', 'Upper Lower Class', 'Lower Class'];
        $data['location'] = District::pluck('name', 'id')->all();
        $data['hearing_source'] = ['Search Engine', 'KPR', 'Social Media', 'Word of mouth', 'SUEPP', 'SF Microfinance', 'Radio', 'TV', 'Print Media', 'Don\'t know'];
        $data['call_type'] = ['Received Service', 'Referral', 'Information related call', 'Inappropriate', 'Information', 'Wrong Number', 'Hang up', 'Got Disconnected'];
        $data['caller'] = ['First Time', 'Regular Caller', 'Follow up', 'Continuation of previous call', 'Don\'t know'];
        $data['pre_mood_rating'] = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $data['main_reason'] = ShojonMainReasonForCalling::pluck('reason', 'id')->all();
        $data['secondary_reason'] = ShojonSecondaryReasonForCalling::pluck('reason', 'id')->all();
        $data['mental_illness_diagnosis'] = ShojonMentalIllnessDiagnosis::pluck('illness', 'id')->all();
        $data['ghq'] = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $data['suicidal_risk'] = ['No', 'Don\'t know', 'Mild', 'Moderate', 'Severe', 'Medical emergency'];
        $data['post_mood_rating'] = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $data['call_effectivenes'] = ['Not at all effective', 'Slightly effective', 'Effective', 'Considerably effective', 'Very effective'];
        $data['client_referral'] = ['No', 'Health Hotline 09678771511', 'Kaan Pete Roi 9612119911', 'Inner Circle 01777772215', 'SHOJON Tier 2 for Psychotherapy', ' SHOJON Tier 3 for Psychiatric Consultation', 'Others'];
        $data['volunteer_id'] = User::pluck('user')->all();
        return $data;
    }

    public function ShojonFilteredData($request, $data)
    {
        $query = CallChecklistForShojon::query();

        $Data = $query->select('agent', 'created_at', 'customer_sec', 'call_started',  'call_ended', 'phone_number', 'caller_name', 'sex', 'age', 'occupation', 'socio_economic_status', 'location', 'hearing_source', 'is_recordable', 'call_type', 'caller', 'service', 'pre_mood_rating', 'main_reason_for_calling', 'secondary_reason_for_calling', 'mental_illness_diagnosis', 'suicidal_risk', 'post_mood_rating', 'call_effectivenes', 'client_referral', 'ref_client_name', 'ref_age', 'ref_therapy_reason', 'ref_phone_number', 'ref_preferred_time', 'ref_emergency_number', 'ref_financial_affort', 'ref_therapist_preference', 'caller_description');

        $Data = $query->whereBetween('created_at', [$data['start'], $data['end']]);

        if ($request->start_time && $request->end_time) {
            $starttime = Carbon::createFromTimeString($request->start_time);
            $endttime = Carbon::createFromTimeString($request->end_time);
            $Data = $query->whereTime('created_at', '>', $starttime);
            $Data = $query->whereTime('created_at', '<', $endttime);
        }

        if (auth()->user()->user_level == 1) {
            $Data = $query->where('agent', auth()->user()->user);
        }

        if ($request->sex)
            $Data = $query->where('sex', $request->sex);
        if ($request->age)
            $Data = $query->where('age', $request->age);
        if ($request->occupation)
            $Data = $query->where('occupation', $request->occupation);
        if ($request->socio_economic_status)
            $Data = $query->where('socio_economic_status', $request->socio_economic_status);
        if ($request->location)
            $Data = $query->where('location', $request->location);
        if ($request->hearing_source)
            $Data = $query->where('hearing_source', $request->hearing_source);
        if ($request->call_type)
            $Data = $query->where('call_type', $request->call_type);
        if ($request->caller)
            $Data = $query->where('caller', $request->caller);
        if ($request->pre_mood_rating)
            $Data = $query->where('pre_mood_rating', $request->pre_mood_rating);
        if ($request->main_reason_for_calling)
            $Data = $query->where('main_reason_for_calling', $request->main_reason_for_calling);
        if ($request->secondary_reason_for_calling)
            $Data = $query->where('secondary_reason_for_calling', $request->secondary_reason_for_calling);
        if ($request->mental_illness_diagnosis)
            $Data = $query->where('mental_illness_diagnosis', $request->mental_illness_diagnosis);
        if ($request->ghq)
            $Data = $query->where('ghq', $request->ghq);
        if ($request->suicidal_risk)
            $Data = $query->where('suicidal_risk', $request->suicidal_risk);
        if ($request->post_mood_rating)
            $Data = $query->where('post_mood_rating', $request->post_mood_rating);
        if ($request->call_effectivenes)
            $Data = $query->where('call_effectivenes', $request->call_effectivenes);
        if ($request->client_referral)
            $Data = $query->where('client_referral', $request->client_referral);
        if ($request->volunteer_id)
            $Data = $query->where('agent', $request->volunteer_id);

        return $Data->get();
    }

    public function exportPdf($range_type = 'last_week')
    {
        ini_set('memory_limit', '4096M');
        ini_set('max_execution_time', 0);

        $requests = CallChecklistForShojon::dayType($range_type);

        $requests = $requests->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf_templates.shojon_records', compact('requests'));

        return $pdf->stream(Carbon::now()->toDateString() . "_ShojonCallChecklistRecords.pdf");
    }

    public function exportExcel(Request $request)
    {
        /* $requests = CallChecklistForShojon::dayType($range_type);

        $requests = $requests->get();
        $filename = Carbon::now()->toDateString() . '-KprCallChecklistRecords';*/

        $data = $this->setFilterParams($request);

        $filtered_data = $this->ShojonFilteredData($request, $data);
        // print_r(gettype($filtered_data));
        // print_r($filtered_data);
        dd($filtered_data);
        return Excel::download(new ShojonCallChecklistExport($filtered_data), 'ShojonCallChecklistReport.xlsx');
    }

    public function dashboard(Request $request)
    {
        $start_time = "2022-01-25";
        $end_time = "2022-04-22";
        // dd($request);

        // if ($request->start_time == null || $request->end_time == null) {
        //     $end_time = Carbon::now()->format('Y-m-d');
        //     $start_time = Carbon::now()->subDays(7)->format('Y-m-d');
        // }

        // if ($request->start_time && $request->end_time) {
        //     $start_time = $request->start_time;
        //     $end_time = $request->end_time;
        // }

        $pageTitle = "Admin Dashboard";

        $call_type = DB::select("select
        count(case when call_type='Hang up call'  then 1 end) as hang_up_call,
        count(case when call_type='Received Service'  then 1 end) as received_service,
        count(case when call_type='Information related call'  then 1 end) as information,
        count(case when call_type='Inappropriate Call'  then 1 end) as inappropriate,
        count(case when call_type='Silent Call'  then 1 end) as silent_calls,
        count(*) as total_cnt 
        from call_checklist_for_shojon
        where (DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time');");

        $sex_cnt = DB::select("select count(case when sex='Male'  then 1 end) as male_cnt, 
        count(case when sex='Female'  then 1 end) as female_cnt, count(*) as total_cnt 
        from call_checklist_for_shojon where (DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time');");

        $call_age = DB::select("select count(case when age='13-19'  then 1 end) as age13_19, 
        count(case when age='20-30'  then 1 end) as age20_30, 
        count(case when age='31-40'  then 1 end) as age31_40, 
        count(case when age='41-65'  then 1 end) as age40_65
        from call_checklist_for_shojon where (DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time');");

        $ref_cnt = DB::select("select  
        count(case when client_referral ='SHOJON Tier 2 for Psychotherapy'  then 1 end) as ref_no_tier2,
        count(case when client_referral ='SHOJON Tier 3 for Psychiatric Consultation'  then 1 end) as ref_no_tier3
        from call_checklist_for_shojon where (DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time');");
        // echo gettype($ref_cnt[0])."\n";
        // dd($ref_cnt[0]);

        $hearing_source = DB::select("select
        count(case when hearing_source='Social Media'  then 1 end) as social_medial,
        count(case when hearing_source='Word of mouth'  then 1 end) as word_of_mouth,
        count(case when hearing_source='Shojon Counselor'  then 1 end) as shojon_counselor,
        count(case when hearing_source='Don\'t know'  then 1 end) as dont_know,
        count(case when hearing_source='From his friend'  then 1 end) as friend

        from call_checklist_for_shojon
        where (DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time');");

        $financial = DB::select("SELECT CAST(ref_financial_affort AS UNSIGNED) as afford, ref_financial_affort FROM 
        `call_checklist_for_shojon` where DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time' and ref_financial_affort IS NOT NULL;");
        // dd($financial);

        // $total_call_cnt = DB::select("select count(*)
        // as total_calls from  call_log c left join vicidial_closer_log cl on c.uniqueid=cl.uniqueid
        // where 1 and c.number_dialed='09612119900' 
        // and (DATE(start_time) >= '$start_time' and DATE(start_time) <= '$end_time');");

        $total_call_cnt = DB::select("select count(*) as total_calls
        from 
        (
        SELECT vl.status 
        from vicidial_users vu,vicidial_closer_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('AGENTDIRECT','AGENTDIRECT_CHAT','SHOJON_In')  
        
        union all
        
        SELECT vl.status 
        from vicidial_users vu,vicidial_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('SHOJON') 
        ) A ");


        $afther_call = DB::select("select count(*) as total_calls
        from 
        (
        SELECT vl.status 
        from vicidial_users vu,vicidial_closer_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('AGENTDIRECT','AGENTDIRECT_CHAT','SHOJON_In')  
        
        union all
        
        SELECT vl.status 
        from vicidial_users vu,vicidial_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('SHOJON') 
        ) A 
        where A.status='AFTHRS';");


        $drop_call = DB::select("select count(*) as total_calls
        from 
        (
        SELECT vl.status 
        from vicidial_users vu,vicidial_closer_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('AGENTDIRECT','AGENTDIRECT_CHAT','SHOJON_In')  
        
        union all
        
        SELECT vl.status 
        from vicidial_users vu,vicidial_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('SHOJON') 
        ) A 
        where A.status='DROP';");


        $time_out = DB::select("select count(*) as total_calls from 
        (
        SELECT vl.status 
        from vicidial_users vu,vicidial_closer_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('AGENTDIRECT','AGENTDIRECT_CHAT','SHOJON_In')  
        
        union all
        
        SELECT vl.status 
        from vicidial_users vu,vicidial_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('SHOJON') 
        ) A 
        
        where A.status='TIMEOT';");

        $recived_call = DB::select("select count(*) as total_calls from 
        (
        SELECT vl.user 
        from vicidial_users vu,vicidial_closer_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('AGENTDIRECT','AGENTDIRECT_CHAT','SHOJON_In')  
        
        union all
        
        SELECT vl.user
        from vicidial_users vu,vicidial_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('SHOJON') 
        ) A 
        
        where A.user!='VDCL';");
        // dd($recived_call);
        // dd($dropp_call->total_calls);

        $INTIMECALL = ($total_call_cnt[0]->total_calls - $afther_call[0]->total_calls);
        $afther_call = $afther_call[0]->total_calls;
        $drop_call = $drop_call[0]->total_calls;
        $time_out = $time_out[0]->total_calls;
        $recived_call = $recived_call[0]->total_calls;
        $call_status[0] = $INTIMECALL;
        $call_status[1] = $afther_call;
        $call_status[2] = $drop_call;
        $call_status[3] = $time_out;
        $call_status[4] = $recived_call;
        //    dd($call_status);

        $lessThenFiftyOne = 0;
        $lessThenHunderdOne = 0;
        $biggerThenHunderdOne = 0;
        foreach ($financial as $x) {
            // echo "$x <br>";

            if ($x->afford > 0 and $x->afford <= 50) {
                $lessThenFiftyOne++;
                // print_r('---------------',  $lessThenFiftyOne)."\n";
                // echo $x->afford . "----- less Then FiftyOne----- "  . $lessThenFiftyOne . "<br>";

            }
            if ($x->afford <= 100 and $x->afford > 50) {
                $lessThenHunderdOne++;
                // print_r('---------------',  $lessThenHunderdOne)."\n";
                // echo $x->afford . "-----less Then HunderdOn----- " .$lessThenHunderdOne . "<br>";
            }
            if ($x->afford > 100) {
                $biggerThenHunderdOne++;
                // print_r('---------------',  $biggerThenHunderdOne)."\n";
                // echo $x->afford . "-----bigger Then HunderdOne----- " . $biggerThenHunderdOne . "<br>";
            }
            // print_r('---------------')."\n";
        };


        // echo "lessThenFiftyOne -" . $lessThenFiftyOne . "<br>";
        // echo "lessThenHunderdOne -" . $lessThenHunderdOne . "<br>";
        // echo "biggerThenHunderdOne -" . $biggerThenHunderdOne . "<br>";
        $total_num = $lessThenFiftyOne + $lessThenHunderdOne + $biggerThenHunderdOne;
        // printf($total_num);
        if ($total_num == 0) {
            $total_num = 1;
        }
        $lessThenFiftyOne = round(($lessThenFiftyOne * 100) / $total_num);
        $lessThenHunderdOne = round(($lessThenHunderdOne * 100) / $total_num);
        $biggerThenHunderdOne = round(($biggerThenHunderdOne * 100) / $total_num);
        // echo "lessThenFiftyOne -" . $lessThenFiftyOne . "<br>";
        // echo "lessThenHunderdOne -" . $lessThenHunderdOne . "<br>";
        // echo "biggerThenHunderdOne -" . $biggerThenHunderdOne . "<br>";
        $financial_aff[0] = $lessThenFiftyOne;
        $financial_aff[1] = $lessThenHunderdOne;
        $financial_aff[2] = $biggerThenHunderdOne;

        // dd($financial);
        // echo gettype($financial)."\n";
        // dd($financial[0]->ref_financial_affort, $financial[0]->afford);




        $total_cnt = $call_type[0]->total_cnt;
        $total_call_cnt = $total_call_cnt[0]->total_calls;
        $call_type = json_encode($call_type[0]);
        $sex_cnt = json_encode($sex_cnt);
        $call_age = json_encode($call_age[0]);
        $hearing_source = json_encode($hearing_source[0]);
        $call_status = json_encode($call_status);
        $financial_aff = json_encode($financial_aff);
        $ref_cnt_tier2 = $ref_cnt[0]->ref_no_tier2;
        $ref_cnt_tier3 = $ref_cnt[0]->ref_no_tier3;

        return view(
            'call_checklist.shojon.dashboard',
            compact(
                'pageTitle',
                'total_call_cnt',
                // 'kprData', 
                // 'data', 
                'sex_cnt',
                'call_type',
                'call_age',
                'total_cnt',
                'ref_cnt_tier2',
                'hearing_source',
                'financial_aff',
                'call_status',
                'ref_cnt_tier3'
            )
        );
    }
}
