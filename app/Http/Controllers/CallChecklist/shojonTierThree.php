<?php

namespace App\Http\Controllers\CallChecklist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class shojonTierThree extends Controller
{
     protected $pageTitle = 'Shojon Tier 3 Service';

    public function tireThreefromblade()
    { 
        $mental_illness = DB::table('shojon_mental_illness_diagnosis')->get();
        $pageTitle = $this->pageTitle;
        return view('call_checklist.shojon.tierThree.create',compact('pageTitle','mental_illness'));
    }
    public function tireThreepatientlist()
    {
        return view('call_checklist.shojon.tierThree.index');
    }
    public function tireThreefrombladequestrion()
    {
        return view('call_checklist.shojon.tierThree.questrion_from');
    }

    // public function tireTow_question_store(Request $request)
    // {
    //     $data=array();
    //     $data['value0']=$request->value1_1;
    //     $data['value1']=$request->value1_2;
    //     $data['value2']=$request->value1_3;
    //     $data['value3']=$request->value1_4;
    //     $data['value4']=$request->value1_5;
    //     $data['value5']=$request->value1_6;
    //     //dd($data);
    //     DB::table('questionairs')->update($data);

    //     return redirect()->back();
    // }

    public function tireThreepatient_save_data(Request $request)
    {
        dd($request->all());
    }
}
