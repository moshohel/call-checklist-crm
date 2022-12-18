<?php

namespace App\Http\Controllers\CallChecklist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class EvaluationController extends Controller
{
     protected $pageTitle = 'Call Evaluation Service'; 
     protected $pageTitlelist = 'Call Evaluation List'; 
     protected $pagedetails = 'Call evaluation details'; 
     public function callEvaluationblade()
     {
        $pageTitle = $this->pageTitle;
         return view('call_checklist.shojon.evaluation.create',compact('pageTitle'));
     }
     public function store(Request $request){
        $data = array();
        $data['name'] = $request->name;
        $data['counselor_name'] = $request->counselor_name;
        $data['duration_call'] = $request->duration_call;
        $data['date'] = $request->date;
        $data['assessment'] = json_encode($request->Assessment);
        $data['observation'] = json_encode($request->Observation);

        DB::table('evaluations')->insert($data);
        return redirect()->back()->with('success', 'insert successfull');
     }

     function callEvaluationIndex()
     {
        $pageTitlelist = $this->pageTitlelist;
        $data = DB::table('evaluations')->get();
        return view('call_checklist.shojon.evaluation.index',compact('pageTitlelist','data'));
     }
     function evaluationDetails($id){
         $pagedetails = $this->pagedetails;
         $data = DB::table('evaluations')->where('id', $id)->first();
         return view('call_checklist.shojon.evaluation.view',compact('pagedetails','data'));
     }
}
