<?php

namespace App\Http\Controllers\CallChecklist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referral;
use Illuminate\Support\Facades\DB;

class shojonTierThree extends Controller
{
    protected $pageTitle = 'Shojon Tier 3 Service';

    public function tireThreefromblade()
    {

        $pageTitle = $this->pageTitle;
        $last = null;
        $districts = DB::table('districts')->get();
        return view('call_checklist.shojon.tierThree.create', compact('pageTitle', 'last', 'districts'));
    }
    public function tireThreepatientlist()
    {
        return view('call_checklist.shojon.tierThree.index');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        if ($request['occupation'] == "on") {
            $request['occupation'] = $request['other_occupation'];
        }
        if ($request['mental_illness_diagnosis'] == "on") {
            $request['mental_illness_diagnosis'] = $request['other_mental_illness_diagnosis'];
        }
        if ($request['current_differential_diagnosis'] == "on") {
            $request['current_differential_diagnosis'] = $request['other_current_differential_diagnosis'];
        }
        if ($request['PresentCotinuation'] == "on") {
            $request['PresentCotinuation'] = $request['other_PresentCotinuation'];
        }
        if ($request['Physical_Concern_history'] == "on") {
            $request['Physical_Concern_history'] = $request['other_Physical_Concern_history'];
        }
        if ($request['client_referral'] == "on") {
            $request['client_referral'] = $request['other_client_referral'];
        }

        $data = array();
        $data['program_name'] = $request->project_name;
        $data['service_providers_name'] = $request->service_providers_name;
        $data['service_providers_di'] = $request->service_providers_id;
        $data['date'] = date('Y-m-d H:i:s');
        $data['time_call_started'] = $request->call_started;
        $data['time_call_ended'] = $request->call_end;
        $data['duration'] = $request->duration;
        $data['phone_number'] = $request->phone_number;
        $data['caller_id'] = $request->caller_id;
        $data['caller_name'] = $request->caller_name;
        $data['sex'] = $request->sex;
        $data['age'] = $request->age;
        $data['occupation'] = $request->occupation;
        $data['location'] = $request->location;
        $data['socio_economic'] = $request->socio_economic_status;
        $data['education'] = $request->Educational_Qualification;
        $data['marital'] = $request->Marital_Status;
        $data['session'] = $request->Session_Number;
        $data['distress'] = $request->distress_rating;
        $data['WHO'] = $request->ghq;
        $data['symptoms'] = implode("; ", $request['Symptoms']);
        $data['severity'] = implode("; ", $request['Severity']);
        $data['problem_duration'] = $request->Problem_duration;
        $data['problem_history'] = $request->problem_history;
        $data['family_history'] = $request->Family_History;
        $data['suicidal_ideation'] = $request->suicidal_risk;
        $data['self_harm_history'] = $request->self_harm_history;
        $data['diagnosis'] = json_encode($request->mental_illness_diagnosis);
        $data['psychiatric_medication'] = $request->PresentCotinuation;
        $data['name_of_medicine'] = $request->name_of_medicine;
        $data['concern_history'] = json_encode($request->Physical_Concern_history);
        $data['differential_diagnosis'] = json_encode($request->current_differential_diagnosis);
        $data['tool_name'] = $request->PsychometricTool;
        $data['score'] = $request->Psychometricscore;
        $data['therapy'] = $request->therapy;
        $data['predisposing'] = implode("; ", $request['Predisposing']);
        $data['precipitatory'] = implode("; ", $request['Precipitatory']);
        $data['perpetuating'] = implode("; ", $request['Perpetuating']);
        $data['protective'] = implode("; ", $request['Protective']);
        $data['short_term'] = $request->ShorttermGoal;
        $data['long_term'] = $request->Longtermgoal;
        $data['intervention'] = $request->Intervention;
        $data['homework'] = $request->Homework;
        $data['effective'] = $request->useful_effective;
        $data['reason_for_referral'] = $request->ReasonForReferral;
        $data['name_of_agency'] = $request->NameOfAgency;
        $data['client_referral'] = $request->client_referral;
        $data['session_plan'] = $request->next_session_plan;
        $data['session_summary'] = $request->session_summary;
        $data['session_date'] = $request->next_session;


        DB::table('shojon_tire_threes')->insert($data);
        return redirect()->back()->with('success', 'Tire three insert successfull');
    }
    public function tireThreerelerral_save_data(Request $request)
    {
        $data = new Referral;
        $data->referr_to = $request->referral_to;
        $data->referr_from = $request->referral_from;
        $data->client_name = $request->client_id;
        $data->client_id = $request->client_name;
        $data->age = $request->age;
        $data->phone_number = $request->phone_number;
        $data->phone_number_two = $request->Emergency_number;
        $data->reason_for_therapy = $request->reason_for_therapy;
        $data->preferred_time = $request->preferred_time;
        $data->financial = $request->Financial;
        $data->therapist = $request->Therapist;
        $data->save();
    }
}
