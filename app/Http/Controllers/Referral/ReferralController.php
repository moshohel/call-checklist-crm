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
        $referral = Referral::where('unique_id', $unique_id)->get();
        // dd($referral);
        $consultants = DB::select('');
        return view('call_checklist.referral.edit', compact('referral', $referral));
    }

    public function update(Request $request)
    {
        // sdfsdf

    }
}
