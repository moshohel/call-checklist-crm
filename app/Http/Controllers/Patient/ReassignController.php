<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Reassign_request;
use App\Models\Referral;
use DB;

class ReassignController extends Controller
{
    protected $pageTitle = 'Doctor Reassign List Page';
    public function reassign_requests(){
        $pageTitle = $this->pageTitle;
        $datas = DB::table('reassign_requests')->where('status','NO')->get();
        return view('call_checklist.patient.reassign._reassign_list',compact('pageTitle','datas'));
    }

    public function reassign_requests_create($id,$unique_id){
        $requesrt = DB::table('reassign_requests')->where('id', $id)->where('status','NO')->first();
        $session = Session::where('unique_id',$unique_id)->where('session_taken','NO')->first();
        $doctor = DB::table('vicidial_users')->where('user', $session->therapist_or_psychiatrist_user_name)->first();
        if($doctor->user_group == "Therapist"){
            $consultants = DB::select('SELECT full_name, user_id, user as user_name FROM vicidial_users WHERE user_group="Therapist"');
        }elseif ($doctor->user_group == "Psychiatrist") {
            $consultants = DB::select('SELECT full_name, user_id, user as user_name FROM vicidial_users WHERE user_group="Psychiatrist"');
        }
        return view('call_checklist.patient.reassign._reassign_create',compact('requesrt','session','consultants'));
    }
    public function reassign_store(Request $request){

        $this->session($request->session_id);
        $this->reassign($request->reassign_list_id);

        $consultant = DB::select("SELECT full_name, user_id, user as user_name FROM vicidial_users WHERE user_id = $request->referred_therapist_or_psychiatrist_user_id");

        $referral = Referral::where('unique_id',$request->unique_id)->latest()->first();

        $duplicatePost = $referral->replicate();
        $duplicatePost->appointment_status = 0;
        $duplicatePost->referred_therapist_or_psychiatrist = $consultant[0]->full_name;
        $duplicatePost->referred_therapist_or_psychiatrist_user_name = $consultant[0]->user_name;
        $duplicatePost->referred_therapist_or_psychiatrist_user_id = $request->referred_therapist_or_psychiatrist_user_id;

        $duplicatePost->save();
        session()->flash('success', 'Reassign Requests Successfully');
        return redirect()->route('reassign.requests');
    }

    function session($id){
        $session = Session::where('id', $id)->first();
        $session->session_taken ="Cancel";
        $session->update();
    }
    function reassign($id){
        $reassign = Reassign_request::where('id', $id)->first();
        $reassign->status = "DONE";
        $reassign->update();
    }
}
