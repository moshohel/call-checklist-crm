<?php

namespace App\Http\Controllers\CallChecklist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referral;
use Illuminate\Support\Facades\DB;
use App\Models\Session;
use App\Models\Termination;

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
        $districts = DB::table('districts')->orderBy('name', 'ASC')->get();
        $newPatient = DB::table('patients')->where('unique_id', $uniqueid)->first();
        $previous_data = DB::table('shojon_tire_threes')->where('caller_id', $uniqueid)->latest()->first();
        // dd($previous_data);
        return view('call_checklist.shojon.tierThree.create', compact('pageTitle', 'last', 'districts', 'session_id', 'uniqueid', 'newPatient', 'previous_data'));
    }
    public function tireThreepatientlist()
    {
        return view('call_checklist.shojon.tierThree.index');
    }
    public function store(Request $request)
    {
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
        if ($request['physical_Concern_history'] == "on") {
            $request['physical_Concern_history'] = $request['other_physical_Concern_history'];
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
        $data['education'] = $request->educational_qualification;
        $data['marital'] = $request->marital_status;
        $data['session'] = $request->session_number;
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
        $data['problem_duration'] = $request->problem_duration;
        $data['problem_history'] = $request->illness_history;
        $data['birth_history'] = $request->birth_history;
        $data['family_history'] = $request->family_history;
        $data['substance_history'] = $request->substance_history;
        $data['suicidal_ideation'] = $request->suicidal_risk;
        $data['self_harm_history'] = $request->self_harm_history;
        $data['diagnosis'] = json_encode($request->mental_illness_diagnosis);
        $data['previous_medication'] = $request->previous_medication;
        $data['concern_history'] = json_encode($request->physical_Concern_history);
        $data['differential_diagnosis'] = json_encode($request->current_differential_diagnosis);
        $data['prescribed_medications'] = $request->prescribed_medications;
        $data['psychotherapy_session_suggested'] = $request->psychotherapy_session_suggested;
        $data['client_ability_buy_medicine'] = $request->client_ability_buy_medicine;
        $data['suitable_session_type'] = $request->suitable_session_type;

        $data['effective'] = $request->useful_effective;
        $data['reason_for_referral'] = $request->ReasonForReferral;
        $data['name_of_agency'] = $request->NameOfAgency;
        $data['client_referral'] = $request->client_referral;
        $data['session_plan'] = $request->next_session_plan;
        $data['session_summary'] = $request->session_summary;
        $data['next_session_date'] = $request->next_session_date;
        $data['next_session_time'] = $request->next_session_time;
        $data['physical_test'] = $request->physical_test;
        $data['message'] = $request->message;

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

    public function clientUpdate($id)
    {
        $pageTitle = $this->pageTitle;
        $last = null;
        $data = DB::table('shojon_tire_threes')->where('id', $id)->first();
        $districts = DB::table('districts')->orderBy('name', 'ASC')->get();
        $newPatient = DB::table('patients')->where('unique_id', $data->caller_id)->first();
        $uniqueid = $data->caller_id;
        return view('call_checklist.shojon.tierThree.edit', compact('pageTitle', 'districts', 'data', 'last', 'uniqueid', 'newPatient'));
    }

    public function TierThreeUpdate(Request $request)
    {

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
        if ($request['physical_Concern_history'] == "on") {
            $request['physical_Concern_history'] = $request['other_physical_Concern_history'];
        }
        if ($request['client_referral'] == "on") {
            $request['client_referral'] = $request['other_client_referral'];
        }
        $data = array();
        $data['phone_number'] = $request->phone_number;
        $data['caller_id'] = $request->client_id;
        $data['caller_name'] = $request->client_name;
        $data['sex'] = $request->sex;
        $data['age'] = $request->age;
        $data['occupation'] = $request->occupation;
        $data['location'] = $request->location;
        $data['socio_economic'] = $request->socio_economic_status;
        $data['education'] = $request->educational_qualification;
        $data['marital'] = $request->marital_status;
        $data['session'] = $request->session_number;
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
        $data['problem_duration'] = $request->problem_duration;
        $data['problem_history'] = $request->illness_history;
        $data['birth_history'] = $request->birth_history;
        $data['family_history'] = $request->family_history;
        $data['substance_history'] = $request->substance_history;
        $data['suicidal_ideation'] = $request->suicidal_risk;
        $data['self_harm_history'] = $request->self_harm_history;
        $data['diagnosis'] = json_encode($request->mental_illness_diagnosis);
        $data['previous_medication'] = $request->previous_medication;
        $data['concern_history'] = json_encode($request->physical_Concern_history);
        $data['differential_diagnosis'] = json_encode($request->current_differential_diagnosis);
        $data['prescribed_medications'] = $request->prescribed_medications;
        $data['psychotherapy_session_suggested'] = $request->psychotherapy_session_suggested;
        $data['client_ability_buy_medicine'] = $request->client_ability_buy_medicine;
        $data['suitable_session_type'] = $request->suitable_session_type;

        $data['effective'] = $request->useful_effective;
        $data['reason_for_referral'] = $request->ReasonForReferral;
        $data['name_of_agency'] = $request->NameOfAgency;
        $data['client_referral'] = $request->client_referral;
        $data['session_plan'] = $request->next_session_plan;
        $data['session_summary'] = $request->session_summary;
        $data['next_session_date'] = $request->next_session_date;
        $data['next_session_time'] = $request->next_session_time;
        $data['physical_test'] = $request->physical_test;
        $data['message'] = $request->message;
        DB::table('shojon_tire_threes')->where('id', $request->id)->update($data);

        return redirect()->back()->with('success', 'Update successfully!');
    }

    public function referral_table(Request $request)
    {
        $uniqueid = $request->caller_id;
        if ($request->ajax()) {
            $output = '';
            $data = Referral::where('unique_id', $uniqueid)->where('referr_from', 'Shojon Tier 3')->get();
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
            $data = Termination::where('client_id', $uniqueid)->where('flag', 'tier3')->get();
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

    public function prescriptionForm()

    {
        return view('call_checklist.shojon.tierThree.prescription_form');
    }
}
