<?php

namespace App\Http\Controllers\CallChecklist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Termination;
use App\Models\Referral;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exports\ShojonTierTowExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Session;
use Illuminate\Support\Facades\Auth;

class Tier2Controller extends Controller
{
    protected $pageTitle = 'Shojon Tier 2 Service';
    protected $pageTitleUpdate = 'Shojon Tier 2 Update';

    public function tireOnefromblade($uniqueid)
    {
        $uniqueid = $uniqueid;
        $pageTitle = $this->pageTitle;
        $districts = DB::table('districts')->orderBy('name', 'ASC')->get();
        $newPatient = DB::table('patients')->where('unique_id', $uniqueid)->first();
        return view('call_checklist.shojon.tier_one.create', compact('pageTitle', 'districts', 'uniqueid', 'newPatient'));
    }

    public function tire2fromblade($uniqueid, $session_id)
    {
        // $uniqueid = $uniqueid; 
        // $pageTitle = $this->pageTitle;
        // $districts = DB::table('districts')->get();
        $session_id = $session_id;

        try {
            $uniqueid = $uniqueid;
            $pageTitle = $this->pageTitle;
            $districts = DB::table('districts')->orderBy('name', 'ASC')->get();
            $newPatient = DB::table('patients')->where('unique_id', $uniqueid)->first();
            // print_r($uniqueid);
            // dd($newPatient);
            // $is_phone_no = DB::table('call_checklist_for_shojon')->where('phone_number', $phone)->first();
            // if ($is_phone_no) {
            //     $previous_data = DB::table('call_checklist_for_shojon')->where('phone_number', $phone)->get();
            //     $last = $previous_data->last();
            // }
            // $districts = DB::table('districts')->get();
            return view('call_checklist.shojon.tier2.create_tier2', compact('pageTitle', 'districts', 'uniqueid', 'newPatient', 'session_id'));
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
        return view('', compact('pageTitle', 'districts'));
    }
    public function store(Request $request)
    {
        // dd($request);
        if ($request->message) {
            $this->sendSms($request->message, $request->phone_number);
        }
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
        $data['caller_id'] = $request->client_id;
        $data['caller_name'] = $request->client_name;
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
        $data['internal_referral'] = $request->Internal_referral;
        $data['external_referral'] = $request->External_referral;
        $data['reason_for_referral'] = $request->ReasonForReferral;
        $data['name_of_agency'] = $request->NameOfAgency;
        $data['client_referral'] = $request->client_referral;
        $data['session_plan'] = $request->next_session_plan;
        $data['session_summary'] = $request->session_summary;
        $data['next_session_date'] = $request->next_session_date;
        $data['next_session_time'] = $request->next_session_time;


        DB::table('sojon_tier2s')->insert($data);

        $id = $request['session_id'];
        // dd($request);
        $session = Session::find($id);
        $session->session_taken = "DONE";
        $session->save();
        $user_id = auth()->user()->user_id;
        // return redirect()->back()->with('success', 'insert successfull');
        return redirect()->route('user.show', $user_id)->with('success', 'insert successfull');
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
    private function sendSms($message, $phone)
    {
        $url = "https://portal.metrotel.com.bd/smsapi";;
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

    public function clientUpdateTierTwo($id, $phone = '')
    {
        $pageTitleUpdate = $this->pageTitleUpdate;
        $data = DB::table('sojon_tier2s')->where('id', $id)->first();
        $previous_data = null;
        $last = null;

        try {
            $is_phone_no = DB::table('sojon_tier2s')->where('phone_number', $phone)->first();
            if ($is_phone_no) {
                $previous_data = DB::table('sojon_tier2s')->where('id', $id)->get();
                $last = $previous_data->last();
            }
            $previous = DB::table('sojon_tier2s')->where('id', $id)->get();

            $districts = DB::table('districts')->orderBy('name', 'ASC')->get();
            return view('call_checklist.shojon.tier2.editTierTwo', compact('pageTitleUpdate', 'districts', 'phone', 'is_phone_no', 'previous_data', 'last', 'data', 'previous'));
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
        return view('', compact('pageTitleUpdate', 'districts'));
    }


    public function tire2patientlist(Request $request)
    {
        $data = DB::table('sojon_tier2s')->get();
        // dd($data);
        $pageTitle = $this->pageTitle;
        return view('call_checklist.shojon.tier2.index', compact('data', 'pageTitle'));
    }
    public function clientDetailsTierTwo($id)
    {
        // $pageTitle = $this->pageTitle;
        $data = DB::table('sojon_tier2s')->where('id', $id)->first();
        return view('call_checklist.shojon.tier2.client_details', compact('data'));
    }

    public function TierTwoUpdate(Request $request)
    {
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
        $data['next_session_date'] = $request->next_session_date;
        $data['next_session_time'] = $request->next_session_time;

        DB::table('sojon_tier2s')->where('id', $request->id)->update($data);

        return redirect()->back()->with('success', 'Update successfully!');
    }
    public function referral_table(Request $request)
    {
        $uniqueid = $request->caller_id;
        if ($request->ajax()) {
            $output = '';
            $data = Referral::where('unique_id', $uniqueid)->where('referr_from', 'Shojon Tier 2')->get();
            if ($data) {
                foreach ($data as $key => $row) {
                    $output .=
                        '<tr>
                    <td>' . $key . '</td>
                    <td>' . $row->referr_to . '</td>
                    <td>' . $row->referr_from . '</td>
                    <td>' . $row->name . '</td>
                    <td>' . $row->unique_id . '</td>
                    <td>' . $row->age . '</td>
                    <td>' . $row->phone_number . '</td>
                    <td>' . $row->phone_number_two . '</td>
                    <td>' . $row->reason_for_therapy . '</td>
                    <td>' . $row->preferred_time . '</td>
                    <td>' . $row->therapist . '</td>
                    <td>' . $row->financial . '</td>
                    <td>' . $row->Referral_types . '</td>
                    </tr>';
                }
                return response()->json($output);
            }
        }
    }
    public function termination_table(Request $request)
    {
        $uniqueid = $request->caller_id;
        if ($request->ajax()) {
            $output = '';
            $array_size = '';
            $data = Termination::where('client_id', $uniqueid)->where('flag', 'tier2')->get();
            if ($data) {
                foreach ($data as $key => $row) {

                    $scheduled = explode(';', $row->scheduled);
                    $attended = explode(';', $row->attended);
                    $cancelled = explode(';', $row->cancelled);
                    $not_attend = explode(';', $row->not_attend);
                    $array_size = sizeof($scheduled);
                    for ($i = 1; $i <= $array_size; $i++) {
                        if ($i == 1) {
                            $output .=
                                '<tr>
                            <td>' . $key . '</td>
                            <td>' . $row->project_name . '</td>
                            <td>' . $row->counselor_name . '</td>
                            <td>' . $row->client_name . '</td>
                            <td>' . $row->client_id . '</td>
                            <td>' . $row->main_reason . '</td>
                            <td>' . $row->who_terminated . '</td>
                            <td>' . $row->referred_date . '</td>
                            <td>' . $row->first_contact . '</td>
                            <td>' . $row->last_session . '</td>
                            <td>' . $row->total_session . '</td>
                            <td>' . '
                            <table>
                            <thead>
                            <tr>
                            <th>Scheduled</th>
                            <th>Attended</th>
                            <th>Cancelled</th>
                            <th>Did not attend</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            <tr>
                            <td>' . $scheduled[$i - 1] . '</td>
                            <td>' . $attended[$i - 1] . '</td>
                            <td>' . $cancelled[$i - 1] . '</td>
                            <td>' . $not_attend[$i - 1] . '</td>
                            </tr>
                            
                            </tbody>
                            </table>
                            ' . '</td>
                            <td>Pre : ' . $row->distress_pre . ' Post: ' . $row->distress_post . '</td>
                            <td>Pre : ' . $row->wellbeing_pre . ' Post: ' . $row->wellbeing_post . '</td>
                            <td>Pre : ' . $row->psychological_pre . ' Post: ' . $row->psychological_post . '</td>
                            <td>' . $row->feedback . '</td>
                            <td>' . $row->learning . '</td>
                            </tr>';
                        } else {
                            $output .=
                                '<tr style ="border-collapse: collapse;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><table>
                            <thead>
                            <tr>
                            <th>Scheduled</th>
                            <th>Attended</th>
                            <th>Cancelled</th>
                            <th>Did not attend</th>
                            </tr>
                            </thead>
                            <tbody>
                            <td>' . $scheduled[$i - 1] . '</td>
                            <td>' . $attended[$i - 1] . '</td>
                            <td>' . $cancelled[$i - 1] . '</td>
                            <td>' . $not_attend[$i - 1] . '</td>
                            </tbody></table>
                            </td>
                            
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
                            ';
                        }
                    }
                }
                return response()->json($output);
            }
        }
    }

    public function tierTow_report(Request $request)
    {
        $fromdate = $request->FromDate;
        $todate = $request->toDate;

        return Excel::download(new ShojonTierTowExport($fromdate, $todate), "$fromdate-$todate.xlsx");
    }


    public function TerminationSave_form(Request $request)
    {
        if ($request['termination'] == "on") {
            $request['termination'] = $request['other_termination'];
        }

        $data = new Termination;
        $data->flag = $request->flag;
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
        $data->scheduled = implode("; ", $request->Scheduled);
        $data->attended = implode("; ", $request->Attended);
        $data->cancelled = implode("; ", $request->Cancelled);
        $data->not_attend = implode("; ", $request->notAttend);
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
    public function ReferralSave_form(Request $request)
    {
        // dd($request);
        $data = new Referral;
        $data->referr_to = $request->referral_to;
        $data->referr_from = $request->referral_from;
        $data->name = $request->client_name;
        $data->unique_id = $request->client_id;
        $data->age = $request->age;
        $data->gender = $request->gender;
        $data->phone_number = $request->phone_number;
        $data->phone_number_two = $request->Emergency_number;
        $data->reason_for_therapy = $request->reason_for_therapy;
        $data->preferred_time = $request->preferred_time;
        $data->financial = $request->Financial;
        $data->Referral_types = $request->Referral_types;
        $data->preferred_therapist_or_psychiatrist = $request->Therapist;
        $data->referred_by =  auth()->user()->full_name;
        $data->id_of_who_referred = auth()->user()->user_id;
        $data->save();
    }
}
