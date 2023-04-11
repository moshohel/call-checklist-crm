<?php

namespace App\Http\Controllers\CallChecklist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referral;
use Illuminate\Support\Facades\DB;
use App\Models\Session;

class shojonTierThree extends Controller
{
    protected $pageTitle = 'Shojon Tier 3 Service';

    public function tireThreefromblade($uniqueid, $session_id)
    {
        // dd($uniqueid);
        $uniqueid = $uniqueid;
        $pageTitle = $this->pageTitle;
        $session_id = $session_id;
        $last = null;
        $districts = DB::table('districts')->get();
        $newPatient = DB::table('patients')->where('unique_id', $uniqueid)->first();
        // dd($newPatient);
        return view('call_checklist.shojon.tierThree.create', compact('pageTitle', 'last', 'districts', 'session_id', 'uniqueid', 'newPatient'));
    }
    public function tireThreepatientlist()
    {
        return view('call_checklist.shojon.tierThree.index');
    }
    public function store(Request $request)
    {
        // dd($request);
        // dd($request->client_id);
        if ($request->next_session_date && $request->next_session_time) {
            $this->nextSession($request->client_id, $request->next_session_date, $request->next_session_time);
        }
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
        $data['appearance'] = $request->examination_appearance;
        $data['behavior'] = $request->examination_behavior;
        $data['speech'] = $request->examination_speech;
        $data['affect'] = $request->examination_affect;
        $data['thought'] = $request->examination_thought;
        $data['perception'] = $request->examination_perception;
        $data['cognition'] = $request->examination_cognition;
        $data['judgement'] = $request->examination_judgement;


        $data['symptoms'] = implode("; ", $request['Symptoms']);
        $data['severity'] = implode("; ", $request['Severity']);
        $data['problem_duration'] = $request->Problem_duration;
        $data['problem_history'] = $request->illness_history;
        $data['birth_history'] = $request->birth_history;
        $data['family_history'] = $request->Family_History;
        $data['substance_history'] = $request->substance_history;
        $data['suicidal_ideation'] = $request->suicidal_risk;
        $data['self_harm_history'] = $request->self_harm_history;
        $data['diagnosis'] = json_encode($request->mental_illness_diagnosis);

        $data['previous_medication'] = $request->previous_medication;
        $data['concern_history'] = json_encode($request->Physical_Concern_history);
        $data['differential_diagnosis'] = json_encode($request->current_differential_diagnosis);
        $data['prescribed_medications'] = $request->prescribed_medications;
        $data['psychotherapy_session_suggested'] = $request->psychotherapy_session_suggested;
        $data['client_ability_buy_medicine'] = $request->client_ability_buy_medicine;
        $data['suitable_session_type'] = $request->suitable_session_type;


        // $data['intervention'] = $request->Intervention;
        // $data['homework'] = $request->Homework;
        $data['effective'] = $request->useful_effective;
        $data['reason_for_referral'] = $request->ReasonForReferral;
        $data['name_of_agency'] = $request->NameOfAgency;
        $data['client_referral'] = $request->client_referral;
        $data['session_plan'] = $request->next_session_plan;
        $data['session_summary'] = $request->session_summary;
        $data['next_session_date'] = $request->next_session_date;
        $data['next_session_time'] = $request->next_session_time;


        DB::table('shojon_tire_threes')->insert($data);
        $id = $request['session_id'];
        // dd($id);
        $session = Session::find($id);
        $session->session_taken = "DONE";
        $session->save();
        $user_id = auth()->user()->user_id;

        // return redirect()->route('call_checklist.shojon.TierThreePatientlist')->with('success', 'Tire three insert successfull');
        return redirect()->route('user.show', $user_id)->with('success', 'Session taken successfull');
    }
    function nextSession($id, $date, $time)
    {
        $session = Session::where('unique_id', $id)->first();

        $duplicatePost = $session->replicate();
        $duplicatePost->session_date = $date;
        $duplicatePost->session_time = $time;
        $duplicatePost->session_taken = "NO";
        $duplicatePost->save();
    }

    public function tireThreeList(Request $request)
    {
        $data = DB::table('shojon_tire_threes')->get();
        $pageTitle = $this->pageTitle;
        return view('call_checklist.shojon.tierThree.index', compact('data', 'pageTitle'));
    }

    public function clientDetails($id)
    {
        // $pageTitle = $this->pageTitle;
        $data = DB::table('shojon_tire_threes')->where('id', $id)->first();
        return view('call_checklist.shojon.tierThree.client_details', compact('data'));
    }

    public function tireThreeUpdate(Request $request)
    {

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
        $data['next_session_time'] = $request->session_summary;
        $data['next_session_date'] = $request->next_session;

        DB::table('shojon_tire_threes')->where('id', $request->id)->update($data);

        return redirect()->back()->with('success', 'Update successfully!');
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
