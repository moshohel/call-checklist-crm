<?php

namespace App\Http\Controllers\Referral;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referral;
use Illuminate\Support\Facades\DB;

class ReferralController extends Controller
{
    public function index()
    {
        // dd(Auth::user()->user_id);
        $referrals = Referral::orderBy('id', 'desc')->get();
        // dd($referrals);
        return view('call_checklist.referral.index', compact('referrals'));
    }

    public function create() 
    {
        return view('call_checklist.referral.create');
    }

    public function store(Request $request)
    {
        $data = new Referral;
        $data->referr_to = $request->referral_to;
        $data->referr_from = $request->referral_from;
        $data->name = $request->client_name;
        $data->unique_id = $request->client_id;
        $data->age = $request->age;
        $data->phone_number = $request->phone_number;
        $data->phone_number_two = $request->Emergency_number;
        $data->reason_for_therapy = $request->reason_for_therapy;
        $data->preferred_time = $request->preferred_time;
        $data->preferred_therapist_or_psychiatrist = $request->preferred_therapist_or_psychiatrist;
        $data->financial = $request->Financial;
        // $data->therapist_or_psychiatrist = $request->therapist_or_psychiatrist;
        $data->save();

        return redirect()->route('referrals');
    }

    public function edit($unique_id, $id)
    {
        $referral = Referral::where('id', $id)->get();
        // dd($referral[0]->referr_to);
        if ($referral[0]->referr_to == "Shojon Tier 2") {
            $consultants = DB::select('SELECT full_name, user_id, user as user_name FROM vicidial_users WHERE user_group="Therapist"');
            // dd($consultants);
        } else {
            $consultants = DB::select('SELECT full_name, user_id, user as user_name FROM vicidial_users WHERE user_group="Psychiatrist"');
        }
        // dd($referral);
        return view('call_checklist.referral.edit', compact('referral', 'consultants'));
    }

    public function showInfo($unique_id, $id)
    {
        $referral = Referral::where('id', $id)->get();
        // dd($referral[0]->referr_to);
        if ($referral[0]->referr_to == "Shojon Tier 2") {
            $consultants = DB::select('SELECT full_name, user_id, user as user_name FROM vicidial_users WHERE user_group="Therapist"');
            // dd($consultants);
        } else {
            $consultants = DB::select('SELECT full_name, user_id, user as user_name FROM vicidial_users WHERE user_group="Psychiatrist"');
        }
        return view('call_checklist.referral.show', compact('referral', 'consultants'));
    }

    public function update(Request $request, $id)
    {
        // dd($id);

        $referral = Referral::find($id);
        $data = $request->only($referral->getFillable());
        $referral->fill($data);
        $referral->save();
        session()->flash('success', 'Edited successfully !!');
        // return redirect()->route('admin.products');
        return redirect()->route('referrals');
    }

    public function referConsultant(Request $request, $id)
    {
        // dd($request);
        $user_id = $request->referred_therapist_or_psychiatrist_user_id;
        $consultant = DB::select("SELECT full_name, user_id, user as user_name FROM vicidial_users WHERE user_id = $user_id");
        // dd($consultant[0]->full_name);
        $referral = Referral::Find($id);
        $referral->already_referred = 1;
        $referral->referred_therapist_or_psychiatrist = $consultant[0]->full_name;
        $referral->referred_therapist_or_psychiatrist_user_name = $consultant[0]->user_name;
        $referral->referred_therapist_or_psychiatrist_user_id = $request->referred_therapist_or_psychiatrist_user_id;
        // dd($referral);
        $referral->save();
        session()->flash('success', 'Referred successfully');

        return redirect()->route('referrals');
    }
}
