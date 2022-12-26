<?php

namespace App\Http\Controllers\CallChecklist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referral;
use DB;

class shojonTierThree extends Controller
{
     protected $pageTitle = 'Shojon Tier 3 Service';

    public function tireThreefromblade()
    { 

        $pageTitle = $this->pageTitle;
        $last = null;
        $districts = DB::table('districts')->get();
        return view('call_checklist.shojon.tierThree.create',compact('pageTitle','last','districts'));
    }
    public function tireThreepatientlist()
    {
        return view('call_checklist.shojon.tierThree.index');
    }
    public function store(Request $request)
    {
        dd($request->all());
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
