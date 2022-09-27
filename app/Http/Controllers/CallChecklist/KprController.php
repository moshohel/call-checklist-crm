<?php

namespace App\Http\Controllers\CallChecklist;

use App\Exports\KprCallChecklistExport;
use App\Http\Controllers\Controller;
use App\Models\CallChecklistForKpr;
use App\Models\District;
use App\Models\KprMainReasonForCalling;
use App\Models\KprCallerExperience;
use App\Models\KprSecondaryReasonForCalling;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Cell;
use Illuminate\Support\Facades\DB;
use DateTime;

class KprController extends Controller
{
    private $pageTitle = 'Call Checklist for KPR';
    protected $monthDuration = 3;

    public function index(Request $request)
    {
        $data = $this->setFilterParams();

        $pageTitle = $this->pageTitle;

        $kprData = $this->KprFilteredData($request, $data);

        return view('call_checklist.kpr.index', compact('pageTitle', 'kprData', 'data'));
    }

    public function dashboard(Request $request)
    {
        // $start_time = "2022-01-25";
        // $end_time = "2022-04-22";

        if ($request->start_time == null || $request->end_time == null) {
            $end_time = Carbon::now()->format('Y-m-d');
            $start_time = Carbon::now()->subDays(7)->format('Y-m-d');

            // printf(gettype($end_time));
            // dd($start_time);
        }

        if ($request->start_time && $request->end_time) {

            $start_time = $request->start_time;
            $end_time = $request->end_time;


            // $start_time = strtotime($request->start_time);
            // $start_time = date('Y-m-d',$start_time);
            // $start_time .= " 00:00:00";
            // // $start_time = DateTime::createFromFormat('YmdHis', $start_time);

            // $end_time = strtotime($request->end_time);
            // $end_time = date('Y-m-d',$end_time);
            // $end_time .= " 00:00:00";

            // $iparr = explode(":", $start_time); 
            // $ipar = explode(":", $end_time); 

            // print "$iparr[0] <br />";
            // print "$ipar[0] <br />";
            // $start_time = $iparr[0];
            // $end_time = $ipar[0];
            // printf(gettype($end_time));
            // printf(gettype($start_time));
            // print_r($start_time);
            // dd($start_time);
            // $start_time = strval($request->start_time);
            // $end_time =strval($request->end_time);

        }

        $pageTitle = $this->pageTitle;

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
            'call_checklist.kpr.dashboard',
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

    public function create($refId, $phone = null)
    {

        $pageTitle = $this->pageTitle;

        try {
            $is_phone_no = CallChecklistForKpr::where('phone_number', $phone)->first();

            $is_admin = ($refId == 123321405060987);

            $districts = District::orderBy('name')->pluck('name');
            $main_reason = KprMainReasonForCalling::all()->pluck('reason');
            $secondary_reason = KprSecondaryReasonForCalling::all()->pluck('reason');
            $caller_experience = KprCallerExperience::all()->pluck('experience');
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        } catch (\Exception $e) {
            return [false, '$e->getError()->message', null];
        }

        // flash()->success('Status Changed Successfully');
        return view('call_checklist.kpr.create', compact('pageTitle', 'districts', 'main_reason', 'secondary_reason', 'caller_experience', 'refId', 'phone', 'is_phone_no', 'is_admin'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'caller_name' => 'required|max:191',
            'sex' => 'required',
            'age' => 'required',
            'occupation' => 'required',
            // 'is_recordable' => 'required',
            'call_type' => 'required',
            'caller' => 'required',
            'risk_level' => 'required',
            'main_reason_for_calling' => 'required',
            'caller_experience' => 'required',
            'client_referral' => 'required',
            'caller_description' => 'required',
        ]);

        $params = $request->except('_token');

        if ($params['caller_name'] == "on") {
            $params['caller_name'] = $params['name'];
        }
        if ($params['occupation'] == "on") {
            $params['occupation'] = $params['other_occupation'];
        }
        if ($params['main_reason_for_calling'] == "on") {
            $params['main_reason_for_calling'] = $params['main_reason'];
        }
        if ($params['client_referral'] == "on") {
            $params['client_referral'] = $params['referral'];
        }



        $data = [
            'referrence_id' => $params['referrence_id'],
            'phone_number' => $params['phone_number'],
            'agent' => (auth()->user() != null) ? auth()->user()->user : "vicidial",
            'call_received' => isset($params['call_received']) ? strftime('%Y-%m-%d %H:%M:%S', strtotime($request->call_received)) : null,
            'call_started' => isset($params['call_started']) ? strftime('%Y-%m-%d %H:%M:%S', strtotime($request->call_started)) : null,
            'call_ended' => isset($params['call_ended']) ? strftime('%Y-%m-%d %H:%M:%S', strtotime($request->call_ended)) : null,
            'caller_name' => $params['caller_name'],
            'sex' => $params['sex'],
            'age' => $params['age'],
            'occupation' => $params['occupation'],
            'location' => isset($params['district']) ? $params['district'] : null,
            'call_type' => $params['call_type'],
            'caller' => $params['caller'],
            'risk_level' => $params['risk_level'],
            'main_reason_for_calling' => $params['main_reason_for_calling'],
            'secondary_reason_for_calling' => isset($params['secondary_reason_for_calling']) ? implode("; ", $params['secondary_reason_for_calling']) : null,
            'caller_experience' => $params['caller_experience'],
            'client_referral' => $params['client_referral'],
            'caller_description' => $params['caller_description'],
            'created_by' => 1,
            'updated_by' => 1
        ];

        CallChecklistForKpr::create($data);

        $status = 'Checklist for KPR created successfully';

        return redirect(route('success'));
    }

    public function KprFilteredData($request, $data)
    {
        $query = CallChecklistForKpr::query();

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
        if ($request->location)
            $Data = $query->where('location', $request->location);
        if ($request->call_type)
            $Data = $query->where('call_type', $request->call_type);
        if ($request->caller)
            $Data = $query->where('caller', $request->caller);
        if ($request->risk_level)
            $Data = $query->where('risk_level', $request->risk_level);
        if ($request->main_reason_for_calling)
            $Data = $query->where('main_reason_for_calling', $request->main_reason_for_calling);
        if ($request->secondary_reason_for_calling)
            $Data = $query->where('secondary_reason_for_calling', $request->secondary_reason_for_calling);
        if ($request->caller_experience)
            $Data = $query->where('caller_experience', $request->caller_experience);
        if ($request->client_referral)
            $Data = $query->where('client_referral', $request->client_referral);
        if ($request->volunteer_id)
            $Data = $query->where('agent', $request->volunteer_id);

        return $Data->get();
    }

    protected function setFilterParams(Request $request = null)
    {
        $request = $request ?: request();

        $data['start'] = $request->start ? Carbon::parse($request->start) : Carbon::now()->subMonths($this->monthDuration);
        $data['end'] = $request->end ? Carbon::parse($request->end) : Carbon::now();


        $data['sex'] = ['Male', 'Female', 'Intersex', 'Others'];
        $data['age'] = ['0-12', '13-19', '20-39', '40-65', '65+', 'Don\'t know'];
        $data['occupation'] = ['Student', 'Has a job', 'Housewife', 'Unemployed', 'Don\'t know'];
        $data['location'] = District::pluck('name', 'id')->all();
        $data['call_type'] = ['Befriended Call', 'Inappropriate', 'Information', 'Wrong Number', 'Hang up', 'Got disconnected'];
        $data['caller'] = ['First time', 'Regular Caller', 'Continuation of previous call', 'Don\'t know'];
        $data['risk_level'] = ['No Risk', 'Slight Risk', 'Moderate Risk', 'Acute Risk', 'Medical Emergency', 'Didn\'t Ask', 'Didn\'t Respond'];
        $data['main_reason'] = KprMainReasonForCalling::pluck('reason', 'id')->all();
        $data['secondary_reason'] = KprSecondaryReasonForCalling::pluck('reason', 'id')->all();
        $data['caller_experience'] = KprCallerExperience::pluck('experience', 'id')->all();
        $data['client_referral'] = ['No', 'Health Hotline', 'Shojon'];
        $data['volunteer_id'] = User::pluck('user')->all();

        return $data;
    }

    public function exportPdf($range_type = 'last_week')
    {
        ini_set('memory_limit', '4096M');
        ini_set('max_execution_time', 0);

        $requests = CallChecklistForKpr::dayType($range_type);

        $requests = $requests->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf_templates.kpr_records', compact('requests'));

        return $pdf->stream(Carbon::now()->toDateString() . "_KprCallChecklistRecords.pdf");
    }



    public function exportExcel(Request $request)
    {
        $data = $this->setFilterParams($request);
        $filtered_data = $this->KprFilteredData($request, $data);
        return Excel::download(new KprCallChecklistExport($filtered_data), 'KprCallChecklistReport.xlsx');
    }
}
