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
        $patient->created_by = Auth::user()->id;

        $patient->created_time = Carbon::now();
        $patient->created_date = Carbon::today();

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
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
