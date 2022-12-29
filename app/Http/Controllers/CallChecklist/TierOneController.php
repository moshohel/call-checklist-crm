<?php

namespace App\Http\Controllers\CallChecklist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShojonTierOne;
use App\Models\Unique;

use DB;

class TierOneController extends Controller
{
   protected $pageTitle = 'Shojon Tier 1 Service'; 
   protected $pageTitleUpdate = 'Shojon Tier 1 Update'; 
   //protected $randomNumber = 999999;


   public function tireOnefromblade($uniqueid)
   { 
    $uniqueid =$uniqueid;   
    $pageTitle = $this->pageTitle;
    $districts = DB::table('districts')->get();
    $newPatient = DB::table('patients')->where('unique_id',$uniqueid)->first();    
    return view('call_checklist.shojon.tier_one.create', compact('pageTitle','districts','uniqueid','newPatient'));
    }

    public function store_tier_One(Request $request)
    {
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
        $data['date'] = date('Y-m-d H:i:s');
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

        DB::table('shojon_tier_ones')->insert($data);
        return redirect()->back()->with('success', 'insert successfull');
    }


    public function tireOneList()
    {
       $pageTitle = $this->pageTitle;
       $data = DB::table('shojon_tier_ones')->get();
       return view('call_checklist.shojon.tier_one.index', compact('pageTitle','data'));
    }

    public function TierOneClientDetails($id)
    {
        $data = DB::table('shojon_tier_ones')->where('id', $id)->first();
        return view('call_checklist.shojon.tier_one._client_details', compact('data'));
    }
    public function TierOneclientUpdate($id)
    {
        $pageTitleUpdate = $this->pageTitleUpdate;
        $districts = DB::table('districts')->get();
        $data = DB::table('shojon_tier_ones')->where('id', $id)->first();
        return view('call_checklist.shojon.tier_one._edit_tier_one', compact('data','pageTitleUpdate','districts')); 
    }
    public function TierOneUpdate(Request $request)
    {
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

        DB::table('shojon_tier_ones')->where('id',$request->id)->update($data);

        return redirect()->back()->with('success', 'Update successfully!');
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
}
