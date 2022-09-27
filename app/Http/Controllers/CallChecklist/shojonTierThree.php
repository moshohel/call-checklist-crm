<?php

namespace App\Http\Controllers\CallChecklist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class shojonTierThree extends Controller
{
     protected $pageTitle = 'Shojon Tier 3 Service';

    public function tireThreefromblade()
    {
        $pageTitle = $this->pageTitle;
        return view('call_checklist.shojon.tierThree.create',compact('pageTitle'));
    }
    public function tireThreepatientlist()
    {
        return view('call_checklist.shojon.tierThree.index');
    }
}
