<?php

namespace App\Http\Controllers\CallChecklist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShojonTierOne;
use App\Models\Unique;
use App\Models\Referral;
use App\Models\Termination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TierOneController extends Controller
{
    protected $pageTitle = 'Shojon Tier 1 Service';
    protected $pageTitleUpdate = 'Shojon Tier 1 Update';
    //protected $randomNumber = 999999;

    protected function uniqueGenerator($model, $throw, $length, $prefix)
    {
        $data = $model::orderBy('id', 'desc')->first();
        if (!$data) {
            $og_length = $length;
            $last_number = '';
        } else {
            $code = substr($data->$throw, strlen($prefix) + 1);
            $actial_last_number = ($code / 1) * 1;
            $increment_last_number = ((int)$actial_last_number + 1);
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for ($i = 0; $i < $og_length; $i++) {
            $zeros .= "0";
        }
        return $prefix . $zeros . $last_number;
    }
    public function tireOnemanual()
    {
        $uniqueId = $this->uniqueGenerator(new Unique, 'unique_id', 6, 'SHO');
        $data = new Unique;
        $data->unique_id = $uniqueId;
        $data->save();
        $getuniqueId = DB::table('uniques')->latest()->first();
        $districts = DB::table('districts')->get();
        return view('call_checklist.shojon.tier_one.manual_form', compact('districts', 'getuniqueId'));
    }


    public function tireOnefromblade($uniqueid)
    {
        $uniqueid = $uniqueid;
        $pageTitle = $this->pageTitle;
        $districts = DB::table('districts')->get();
        $newPatient = DB::table('patients')->where('unique_id', $uniqueid)->first();
        return view('call_checklist.shojon.tier_one.create', compact('pageTitle', 'districts', 'uniqueid', 'newPatient'));
    }

    public function store_tier_One(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'client_id' => 'required|unique:shojon_tier_ones,caller_id|max:25',
        ]);

        if ($request->message) {
            $this->sendSms($request->message, $request->phone_number);
        }
        if ($request['occupation'] == "on") {
            $request['occupation'] = $request['other_occupation'];
        }
        if ($request['about_shojon'] == "on") {
            $request['about_shojon'] = $request['other_about_shojon'];
        }
        if ($request['secondary_reason'] == "on") {
            $request['secondary_reason'] = $request['other_secondary_reason'];
        }
        if ($request['mental_illness_diagnosis'] == "on") {
            $request['mental_illness_diagnosis'] = $request['other_mental_illness_diagnosis'];
        }
        if ($request['name_of_agency'] == "on") {
            $request['name_of_agency'] = $request['other_name_of_agency'];
        }

        $data = array();
        $data['program_name'] = $request->project_name;
        $data['service_providers_name'] = $request->service_providers_name;
        $data['service_providers_di'] = $request->service_providers_id;
        $data['date'] = date('Y-m-d');
        $data['time'] = date('H:i:s');
        $data['time_call_started'] = $request->call_started;
        $data['time_call_ended'] = $request->call_end;
        $data['duration'] = $request->duration;
        $data['phone_number'] = $request->phone_number;
        $data['caller_id'] = $request->client_id;
        $data['caller_name'] = $request->client_name;
        $data['sex'] = $request->sex;
        $data['age'] = $request->age;
        $data['socio_economic'] = $request->socio_economic;
        $data['location'] = $request->location;
        $data['call_Type'] = $request->call_type;
        $data['caller'] = $request->caller;
        $data['occupation'] = $request->occupation;
        $data['hear_about_shojon'] = $request->about_shojon;
        $data['distress'] = $request->Distress;
        $data['primary_reason'] = $request->primary_reason;
        $data['secondary_reason'] = json_encode($request->secondary_reason);
        $data['mental_illness_diagnosis'] = json_encode($request->mental_illness_diagnosis);
        $data['who'] = $request->ghq;
        $data['suicidal_risk'] = $request->suicidal_risk;
        $data['effective'] = $request->effective;
        $data['internal_referr'] = $request->Internal_Referral;
        $data['reason_for_referral'] = $request->reason_for_referral;
        $data['name_of_agency'] = $request->name_of_agency;
        $data['call_description'] = $request->call_description;
        $data['message'] = $request->message;
        $data['created_at'] = Carbon::now();

        DB::table('shojon_tier_ones')->insert($data);

        return redirect()->route('call_checklist.shojon.TierOneList');
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

    public function tireOneList()
    {
        $pageTitle = $this->pageTitle;
        $userGroup = Auth::user()->user_group;
        $userId = Auth::user()->user_id;
        if ($userGroup == "ADMIN") {
            $data = DB::table('shojon_tier_ones')->get();
        } else {
            $data = DB::table('shojon_tier_ones')->where('service_providers_di', '=', $userId)->get();
        }

        return view('call_checklist.shojon.tier_one.index', compact('pageTitle', 'data'));
    }

    public function TierOneClientDetails($id)
    {
        $data = DB::table('shojon_tier_ones')->where('id', $id)->first();
        return view('call_checklist.shojon.tier_one._client_details', compact('data'));
    }
    public function TierOneclientUpdate($caller_id)
    {
        $uniqueid = $caller_id;
        $pageTitleUpdate = $this->pageTitleUpdate;
        $districts = DB::table('districts')->get();
        $newPatient = DB::table('patients')->where('unique_id', $caller_id)->first();
        $data = DB::table('shojon_tier_ones')->where('caller_id', $caller_id)->first();
        return view('call_checklist.shojon.tier_one._edit_tier_one', compact('data', 'pageTitleUpdate', 'districts', 'uniqueid', 'newPatient'));
    }
    public function TierOneUpdate(Request $request)
    {
        if ($request->message) {
            $this->sendSms($request->message, $request->phone_number);
        }
        if ($request['occupation'] == "on") {
            $request['occupation'] = $request['other_occupation'];
        }
        if ($request['about_shojon'] == "on") {
            $request['about_shojon'] = $request['other_about_shojon'];
        }
        if ($request['secondary_reason'] == "on") {
            $request['secondary_reason'] = $request['other_secondary_reason'];
        }
        if ($request['mental_illness_diagnosis'] == "on") {
            $request['mental_illness_diagnosis'] = $request['other_mental_illness_diagnosis'];
        }
        if ($request['name_of_agency'] == "on") {
            $request['name_of_agency'] = $request['other_name_of_agency'];
        }

        $data = array();
        $data['phone_number'] = $request->phone_number;
        $data['caller_name'] = $request->client_name;
        $data['sex'] = $request->sex;
        $data['age'] = $request->age;
        $data['socio_economic'] = $request->socio_economic;
        $data['location'] = $request->location;
        $data['call_Type'] = $request->call_type;
        $data['caller'] = $request->caller;
        $data['occupation'] = $request->occupation;
        $data['hear_about_shojon'] = $request->about_shojon;
        $data['distress'] = $request->Distress;
        $data['primary_reason'] = $request->primary_reason;
        $data['secondary_reason'] = json_encode($request->secondary_reason);
        $data['mental_illness_diagnosis'] = json_encode($request->mental_illness_diagnosis);
        $data['who'] = $request->ghq;
        $data['suicidal_risk'] = $request->suicidal_risk;
        $data['effective'] = $request->effective;
        $data['internal_referr'] = $request->Internal_Referral;
        $data['reason_for_referral'] = $request->reason_for_referral;
        $data['name_of_agency'] = $request->name_of_agency;
        $data['call_description'] = $request->call_description;
        $data['message'] = $request->message;

        DB::table('shojon_tier_ones')->where('id', $request->id)->update($data);

        return redirect()->route('call_checklist.shojon.TierOneList')->with('success', 'insert successfull');
    }

    public function referral_table(Request $request)
    {
        $uniqueid = $request->caller_id;
        if ($request->ajax()) {
            $output = '';
            $data = Referral::where('unique_id', $uniqueid)->where('referr_from', 'Shojon Tier 1')->get();
            if ($data) {
                foreach ($data as $key => $row) {
                    $output .=
                        '<tr>
                    <td>' . $key . '</td>
                    <td>' . $row->referr_from . '</td>
                    <td>' . $row->referr_to . '</td>
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
    // public function uniqueId()
    // {
    //    $url = "https://masking.viatech.com.bd/smsnet/bulk/api";       
    //    $data = [
    //      "auth" => [
    //        "username" => "metrotest", 
    //        "api_key" => "836252ef68aec5a0a39aac9709da5b33265", 
    //        "api_secret" => "d610abe6618dd90d8b89ec2838ee12ac265" 
    //     ], 
    //    "sms_data" => [
    //     [
    //      "recipient" => "01798498684", 
    //      "mask" => "BMCCI", 
    //      "message" => "Test Message 1" 
    //     ], 
    //     [
    //       "recipient" => "01798498684", 
    //       "mask" => "BMCCI", 
    //       "message" => "Test Message 2" 
    //     ] 

    //     ] 
    //     ]; 
    // $ch = curl_init();
    //   curl_setopt($ch, CURLOPT_URL, $url);
    //   curl_setopt($ch, CURLOPT_POST, 1);
    //   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //   $response = curl_exec($ch);
    //   curl_close($ch);
    //   print_r($response)


    // }

    // public function ran_num_fun()
    // {
    //     $ran_num = $this->randomNumber;
    //     //$randomNumber = 000001
    //     for ($i=0; $i < $ran_num; $i++) { 
    //         // code...
    //     }
    // }


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
            'call_checklist.shojon.tier_one.dashboard',
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
