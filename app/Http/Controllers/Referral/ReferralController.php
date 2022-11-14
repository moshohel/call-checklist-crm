<?php

namespace App\Http\Controllers\Referral;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referral;

class ReferralController extends Controller
{
    public function index()
    {
        // dd(Auth::user()->user_id);
        $referrals = Referral::orderBy('id', 'desc')->get();
        // dd($referrals);
        return view('call_checklist.referral.index', compact('referrals'));
    }
}
