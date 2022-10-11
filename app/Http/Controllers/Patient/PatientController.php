<?php

namespace App\Http\Controllers\Patient;

use App\Models\Patient;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\District;
use App\Models\ShojonMainReasonForCalling;
use App\Models\ShojonMentalIllnessDiagnosis;
use App\Models\ShojonSecondaryReasonForCalling;
use Illuminate\Support\Facades\DB;
use App\Models\CallChecklistForShojon;

class PatientController extends Controller
{

    protected $pageTitle = 'Call Checklist for Shojon';
    protected $monthDuration = 3;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Auth::user()->user_id);
        $patients = Patient::orderBy('id', 'desc')->get();
        return view('call_checklist.patient.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($refId = 0, $phone = '')
    {
        $pageTitle = $this->pageTitle;
        $previous_data = null;

        $districts = District::orderBy('name')->pluck('name');
        $main_reason = ShojonMainReasonForCalling::all()->pluck('reason');
        $secondary_reason = ShojonSecondaryReasonForCalling::all()->pluck('reason');
        $mental_illness = ShojonMentalIllnessDiagnosis::all()->pluck('illness');
        return view('call_checklist.patient.create', compact('pageTitle', 'districts', 'main_reason', 'secondary_reason', 'mental_illness', 'refId', 'phone'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = new Patient();
        $data = $request->only($patient->getFillable());
        $patient->fill($data);
        $patient->created_by = auth()->id();
        // print_r(auth()->id());
        $patient->created_at = Carbon::now();
        // $patient->created_date = Carbon::today();
        $patient->unique_id = rand(100000, 999999);
        // dd($patient);
        $patient->save();
        session()->flash('success', 'New patient has added successfully !!');
        // return redirect()->route('admin.products');
        return redirect()->route('patients');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);
        // return view('pages.patient.show')->with('patient', $patient);
        return view('call_checklist.patient.show', compact('patient'));
    }

    public function showInfo($phone)
    {
        $pageTitle = $this->pageTitle;
        // dd($phone);
        // $patient = Patient::find($phone);
        $previous_data = null;
        $last = null;

        $is_phone_no = CallChecklistForShojon::where('phone_number', $phone)->first();
        if ($is_phone_no) {
            $previous_data = CallChecklistForShojon::where('phone_number', $phone)->get();
        }

        $patient = DB::select("SELECT * FROM patients WHERE phone_number = $phone");
        // $queries = DB::select("SELECT * FROM queries WHERE phone = $phone");
        // dd($previous_data);
        return view('call_checklist.patient.showInfo', compact('pageTitle', 'is_phone_no', 'previous_data', 'patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = $this->pageTitle;
        $patient = Patient::find($id);
        // $consultants = Consultant::orderBy('id', 'desc')->get();
        $districts = District::orderBy('name')->pluck('name');
        $main_reason = ShojonMainReasonForCalling::all()->pluck('reason');
        $secondary_reason = ShojonSecondaryReasonForCalling::all()->pluck('reason');
        $mental_illness = ShojonMentalIllnessDiagnosis::all()->pluck('illness');
        return view('call_checklist.patient.edit', compact('pageTitle', 'patient', 'districts', 'main_reason', 'secondary_reason', 'mental_illness'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);
        //   dd($patient);
        $data = $request->only($patient->getFillable());
        $patient->fill($data);
        $patient->updated_by = auth()->id();
        $patient->save();
        session()->flash('success', 'Patient Edited successfully !!');
        // return redirect()->route('admin.products');
        return redirect()->route('patients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $patient = Patient::find($id);
        if (!is_null($patient)) {
            $patient->delete();
        }

        session()->flash('success', 'Patient has deleted successfully !!');

        //   return back();
        return redirect()->route('patients');
    }
}
