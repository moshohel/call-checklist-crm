<?php

namespace App\Http\Controllers\CallChecklist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Termination;
use DB;
class Tier2Controller extends Controller
{
    protected $pageTitle = 'Shojon Tier 2 Service';

    public function tire2fromblade($refId = 0, $phone = '')
    {
        $pageTitle = $this->pageTitle;
        $previous_data = null;
        $last = null;

        try {
            $is_phone_no = DB::table('call_checklist_for_shojon')->where('phone_number', $phone)->first();
            if ($is_phone_no) {
                $previous_data = DB::table('call_checklist_for_shojon')->where('phone_number', $phone)->get();
                $last = $previous_data->last();
            }

            $districts = DB::table('districts')->get();
            $main_reason = DB::table('shojon_main_reason_for_calling')->pluck('reason');
            $secondary_reason = DB::table('shojon_secondary_reason_for_calling')->pluck('reason');
            $mental_illness = DB::table('shojon_mental_illness_diagnosis')->get();

            return view('call_checklist.shojon.tier2.create_tier2', compact('pageTitle', 'districts', 'main_reason', 'secondary_reason', 'mental_illness', 'refId', 'phone', 'is_phone_no', 'previous_data', 'last'));
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
        return view('',compact('pageTitle','districts'));
    }
    public function store(Request $request)
    {
        //$params = $request->except('_token');

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

        $data=array();
        $data['program_name']=$request->project_name;
        $data['service_providers_name']=$request->service_providers_name;
        $data['service_providers_di']=$request->service_providers_id;
        $data['date']=date('Y-m-d H:i:s');
        $data['time_call_started']=$request->call_started;
        $data['time_call_ended']=$request->call_end;
        $data['duration']=$request->duration;
        $data['phone_number']=$request->phone_number;
        $data['caller_id']=$request->caller_id;
        $data['caller_name']=$request->caller_name;
        $data['sex']=$request->sex;
        $data['age']=$request->age;
        $data['occupation']=$request->occupation;
        $data['location']=$request->location;
        $data['socio-economic']=$request->socio_economic_status;
        $data['education']=$request->Educational_Qualification;
        $data['marital']=$request->Marital_Status;
        $data['session']=$request->Session_Number;
        $data['distress']=$request->distress_rating;
        $data['WHO']=$request->ghq;
        $data['symptoms']=implode("; ",$request['Symptoms']);
        $data['severity']=implode("; ",$request['Severity']);
        $data['problem_duration']=$request->Problem_duration;
        $data['problem_history']=$request->problem_history;
        $data['family_history']=$request->Family_History;
        $data['suicidal_ideation']=$request->suicidal_risk;
        $data['self_harm_history']=$request->self_harm_history;
        $data['diagnosis']=implode("; ",$request['mental_illness_diagnosis']);
        $data['psychiatric_medication']=$request->PresentCotinuation;
        $data['concern_history']=implode("; ",$request['Physical_Concern_history']);
        $data['differential_diagnosis']=implode("; ",$request['current_differential_diagnosis']);
        $data['tool_name']=$request->PsychometricTool;
        $data['score']=$request->Psychometricscore;
        $data['therapy']=$request->therapy;
        $data['predisposing']=implode("; ",$request['Predisposing']);
        $data['precipitatory']=implode("; ",$request['Precipitatory']);
        $data['perpetuating']=implode("; ",$request['Perpetuating']);
        $data['protective']=implode("; ",$request['Protective']);
        $data['short_term']=$request->ShorttermGoal;
        $data['long_term']=$request->Longtermgoal;
        $data['intervention']=$request->Intervention;
        $data['homework']=$request->Homework;
        $data['effective']=$request->useful_effective;
        $data['session_summary']=$request->caller_description;
        //dd($data);

        DB::table('sojon_tier2s')->insert($data);
        return redirect()->back()->with('success','insert successfull');
    }
    public function tireTow_question_store(Request $request)
    {
        $data=array();
        $data['value5']=$request->value;
        
        //dd($data);
        DB::table('questionairs')->update($data);

        return redirect()->back();
    }

    public function tire2patientlist()
    {
        $data = DB::table('sojon_tier2s')->get();
        $pageTitle = $this->pageTitle;

        return view('call_checklist.shojon.tier2.index',compact('data','pageTitle'));
    }
    public function save_data(Request $request)
    {
        dd($request->all());
    }

    public function TerminationSave_form(Request $request)
    {
         if ($request['termination'] == "on") {
            $request['termination'] = $request['other_termination'];
        }

       $data = new Termination;
       $data->project_name = $request->project_name;
       $data->counselor_name = $request->Counselor_name;
       $data->client_name = $request->Client_name;
       $data->client_id = $request->Client_id;
       $data->date = date('Y-m-d H:i:s');
       $data->main_reason = $request->termination;
       $data->who_terminated = $request->whoTerminated;
       $data->referred_date = $request->ReferredDate;
       $data->first_contact = $request->firstContact;
       $data->last_session = $request->lastSession;
       $data->total_session = $request->NoOfSessions;
       $data->scheduled = implode("; ",$request->Scheduled);
       $data->attended = implode("; ",$request->Attended);
       $data->cancelled = implode("; ",$request->Cancelled);
       $data->not_attend = implode("; ",$request->notAttend);
       $data->distress_pre = $request->Distress_pre;
       $data->distress_post = $request->Distress_post;
       $data->wellbeing_pre = $request->Wellbeing_pre;
       $data->wellbeing_post = $request->Wellbeing_post;
       $data->psychological_pre = $request->Psychological_pre;
       $data->psychological_post = $request->Psychological_post;
       $data->feedback = $request->feedback;
       $data->learning = $request->learning_session;
       $data->save();
    }
}
