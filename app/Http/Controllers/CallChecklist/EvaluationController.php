<?php

namespace App\Http\Controllers\CallChecklist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EvaluationExport;
use App\Models\Evaluation;

class EvaluationController extends Controller
{
   protected $pageTitle = 'Call Evaluation Form';
   protected $pageTitlelist = 'Call Evaluation List';
   protected $pagedetails = 'Call evaluation details';
   public function callEvaluationblade()
   {
      $pageTitle = $this->pageTitle;
      return view('call_checklist.shojon.evaluation.create', compact('pageTitle'));
   }
   public function store(Request $request)
   {
      // dd($request);
      $data = array();
      $data['name'] = $request->name;
      $data['counselor_name'] = $request->counselor_name;
      $data['duration_call'] = $request->duration_call;
      $data['rating_score'] = $request->rating_score;
      $data['recommendation'] = $request->recommendation;
      $data['date'] = $request->date;
      $data['assessment'] = json_encode($request->Assessment);
      $data['observation'] = json_encode($request->Observation);

      DB::table('evaluations')->insert($data);
      // return redirect()->back()->with('success', 'insert successfull');
      return redirect()->route('call_checklist.shojon.eva_index')->with('success', 'Added Successfull');
   }

   function callEvaluationIndex()
   {
      $pageTitlelist = $this->pageTitlelist;
      $data = DB::table('evaluations')->get();
      return view('call_checklist.shojon.evaluation.index', compact('pageTitlelist', 'data'));
   }
   function evaluationDetails($id)
   {
      $pagedetails = $this->pagedetails;
      $data = DB::table('evaluations')->where('id', $id)->first();
      // dd($data);
      return view('call_checklist.shojon.evaluation.view', compact('pagedetails', 'data'));
   }

   public function evaluationExcel(Request $request)
   {
      return Excel::download(new EvaluationExport, 'evaluationlist.xlsx');
   }

   public function evaluationTable()
   {
      $data = Evaluation::all();
      return view('Export.evaluation', compact('data'));
   }
}
