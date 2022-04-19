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

    public function create($refId = 0, $phone = '')
    {

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
        $this->validate($request, [
            'referrence_id' => 'required',
            'phone_number' => 'required',
            'sex' => 'required',
            'age' => 'required',
            'occupation' => 'required',
            'location' => 'required',
            'hearing_source' => 'required',
            'call_type' => 'required',
            'caller' => 'required',
            'main_reason_for_calling' => 'required',
            'secondary_reason_for_calling' => 'required',
            'mental_illness_diagnosis' => 'required',
            'ghq' => 'required',
            'call_effectivenes' => 'required',
            'client_referral' => 'required',
            'caller_description' => 'required',
        ]);

        if ($request->message) {
            $this->sendSms($request->message, $request->phone_number);
        }

        $params = $request->except('_token');

        if ($params['occupation'] == "on") {
            $params['occupation'] = $params['other_occupation'];
        }
        if ($params['hearing_source'] == "on") {
            $params['hearing_source'] = $params['other_hearing_source'];
        }
        if ($params['main_reason_for_calling'] == "on") {
            $params['main_reason_for_calling'] = $params['other_main_reason_for_calling'];
        }
        if ($params['secondary_reason_for_calling'] == "on") {
            $params['secondary_reason_for_calling'] = $params['other_secondary_reason_for_calling'];
        } elseif ($params['other_secondary_reason_for_calling'][0] != null) {
            $params['secondary_reason_for_calling'] = array_merge($params['secondary_reason_for_calling'], $params['other_secondary_reason_for_calling']);
        }
        if ($params['mental_illness_diagnosis'] == "on") {
            $params['mental_illness_diagnosis'] = $params['other_mental_illness_diagnosis'];
        } elseif ($params['mental_illness_diagnosis'][0] != null) {
            $params['mental_illness_diagnosis'] = array_merge($params['mental_illness_diagnosis'], $params['other_mental_illness_diagnosis']);
        }
        if ($params['client_referral'] == "on") {
            $params['client_referral'] = $params['other_client_referral'];
        }

        $data = [
            'referrence_id' => $params['referrence_id'],
            'phone_number' => $params['phone_number'],
            'agent' => (auth()->user() != null) ? auth()->user()->user : "vicidia",
            'caller_name' => isset($params['caller_name']) ? $params['caller_name'] : null,
            'caller_id' => 1,
            'sex' => $params['sex'],
            'age' => $params['age'],
            'occupation' => $params['occupation'],
            'socio_economic_status' => isset($params['socio_economic_status']) ? $params['socio_economic_status'] : null,
            'location' => $params['location'],
            'hearing_source' => $params['hearing_source'],
            'call_type' => $params['call_type'],
            'caller' => $params['caller'],
            'pre_mood_rating' => $params['pre_mood_rating'],
            'main_reason_for_calling' => $params['main_reason_for_calling'],
            'secondary_reason_for_calling' => implode("; ", $params['secondary_reason_for_calling']),
            'mental_illness_diagnosis' => implode("; ", $params['mental_illness_diagnosis']),
            'ghq' => $params['ghq'],
            'suicidal_risk' => isset($params['suicidal_risk']) ? $params['suicidal_risk'] : null,
            'post_mood_rating' => $params['post_mood_rating'],
            'call_effectivenes' => $params['call_effectivenes'],
            'client_referral' => $params['client_referral'],
            'caller_description' => $params['caller_description'],
            'ref_client_name' => $params['ref_client_name'] ? $params['ref_client_name'] : null,
            'ref_age' => $params['ref_age'] ? $params['ref_age'] : null,
            'ref_therapy_reason' => $params['ref_therapy_reason'] ? $params['ref_therapy_reason'] : null,
            'ref_phone_number' => $params['ref_phone_number'] ? $params['ref_phone_number'] : null,
            'ref_preferred_time' => $params['ref_preferred_time'] ? $params['ref_preferred_time'] : null,
            'ref_emergency_number' => $params['ref_emergency_number'] ? $params['ref_emergency_number'] : null,
            'ref_financial_affort' => $params['ref_financial_affort'] ? $params['ref_financial_affort'] : null,
            'ref_therapist_preference' => $params['ref_therapist_preference'] ? $params['ref_therapist_preference'] : null,
            'created_by' => 1,
            'updated_by' => 1
        ];

        CallChecklistForShojon::create($data);

        $status = 'Checklist for Shojon created successfully';

        return redirect(route('success'));
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
        $data['client_referral'] = ['No', 'Health Hotline 09678771511', 'Kaan Pete Roi 9612119911', 'Inner Circle 01777772215', 'SHOJON Tier 2 for Psychotherapy', ' SHOJON Tier 3 for Psychiatric Consultation','Others'];
        $data['volunteer_id'] = User::pluck('user')->all();
        return $data;
    }

    public function ShojonFilteredData($request, $data)
    {
        $query = CallChecklistForShojon::query();

        $Data = $query->select('agent', 'created_at', 'customer_sec','call_started',  'call_ended','phone_number', 'caller_name', 'sex','age','occupation', 'socio_economic_status', 'location', 'hearing_source', 'is_recordable', 'call_type', 'caller', 'service', 'pre_mood_rating', 'main_reason_for_calling', 'secondary_reason_for_calling', 'mental_illness_diagnosis', 'suicidal_risk', 'post_mood_rating', 'call_effectivenes', 'client_referral', 'ref_client_name','ref_age', 'ref_therapy_reason','ref_phone_number','ref_preferred_time','ref_emergency_number','ref_financial_affort','ref_therapist_preference', 'caller_description');

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
            $Data = $query->where('agent',$request->volunteer_id);

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

        return Excel::download(new ShojonCallChecklistExport($filtered_data), 'ShojonCallChecklistReport.xlsx');
    }
}
