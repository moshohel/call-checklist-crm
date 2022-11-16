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

    public function edit($unique_id, $id)
    {
        $referral = Referral::where('id', $id)->get();
        // dd($referral[0]->referr_to);
        if ($referral[0]->referr_to == "Shojon Tier 2") {
            $consultants = DB::select('SELECT full_name FROM vicidial_users WHERE user_group="Therapist"');
            // dd($consultants);
        } else {
            $consultants = DB::select('SELECT full_name FROM vicidial_users WHERE user_group="Psychiatrist"');
        }
        return view('call_checklist.referral.edit', compact('referral', 'consultants'));
    }

    public function showInfo($unique_id, $id)
    {
        $referral = Referral::where('id', $id)->get();
        // dd($referral[0]->referr_to);
        if ($referral[0]->referr_to == "Shojon Tier 2") {
            $consultants = DB::select('SELECT full_name FROM vicidial_users WHERE user_group="Therapist"');
            // dd($consultants);
        } else {
            $consultants = DB::select('SELECT full_name FROM vicidial_users WHERE user_group="Psychiatrist"');
        }
        return view('call_checklist.referral.show', compact('referral', 'consultants'));
    }

    public function update(Request $request, $id)
    {
        dd($request);
    }

    public function referConsultant(Request $request, $id)
    {
        $referral = Referral::Find($id);
        $referral->already_referred = 1;
        $referral->referred_therapist_or_psychiatrist = $request->referred_therapist_or_psychiatrist;
        $referral->save();
        session()->flash('success', 'Referred successfully');

        return redirect()->route('referrals');
    }
}
