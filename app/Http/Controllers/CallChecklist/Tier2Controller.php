<?php

namespace App\Http\Controllers\CallChecklist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
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
            $mental_illness = DB::table('shojon_mental_illness_diagnosis')->pluck('illness');

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
        if ($request['PresentCotinuation'] == "on") {
            $request['PresentCotinuation'] = $request['other_PresentCotinuation'];
        }
         if ($request['Physical_Concern_history'] == "on") {
            $request['Physical_Concern_history'] = $request['other_Physical_Concern_history'];
        }

        $data=array();
        $data['service_providers_name']=$request->service_providers_name;
        $data['program_name']=$request->Programer_name;
        $data['service_providers_di']=$request->service_providers_id;
        $data['date']=date('Y-m-d H:i:s');
        $data['caller']=$request->caller;
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

    public function tire2patientlist()
    {
        $data = DB::table('sojon_tier2s')->get();
        $pageTitle = $this->pageTitle;

        return view('call_checklist.shojon.tier2.index',compact('data','pageTitle'));
    }
}
