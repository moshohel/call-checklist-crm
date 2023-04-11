<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ReassignController extends Controller
{
    protected $pageTitle = 'Doctor Reassign List Page';
    public function reassign_requests(){
        $pageTitle = $this->pageTitle;
        $datas = DB::table('reassign_requests')->get();
        return view('call_checklist.patient.reassign._reassign_list',compact('pageTitle','datas'));
    }
}
