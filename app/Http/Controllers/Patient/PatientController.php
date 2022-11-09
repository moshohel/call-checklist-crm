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

    public function search(Request $request)
    {

        $unique_id = $request->unique_id;
        $phone_number = $request->phone_number;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $str = '';
        if ($unique_id != '') {
            $str .= " and patients.unique_id ='$unique_id' ";
        }
        if ($phone_number != '') {
            $str .= " and patients.phone_number ='$phone_number' ";
        }
        if ($from_date != '') {
            $str .= " and DATE(patients.created_at) >= '$from_date' ";
        }
        if ($to_date != '') {
            $str .= " and DATE(patients.created_at) <= '$to_date' ";
        }
        // echo $str;

        $json_data = array(
            "additional_query" => $str,
        );
        echo json_encode($json_data);
    }

    public function paging(Request $request)
    {
        // DataTable sends this draw, search, start, length
        $draw = $request->draw;
        $search = $request->search;
        $start = $request->start;
        $length = $request->length;

        // additional_query is the query string for filtering data 
        // form submit calles search which genarate this Query String 
        $additional_query = $request->additional_query;
        // $patients = DB::select("SELECT consultants.name as consultant_name, patients.* FROM patients LEFT JOIN consultants ON consultants.id= patients.consultant_id WHERE 1 $additional_query limit $start ,$length");
        $patients = DB::select("SELECT * FROM patients WHERE 1 $additional_query limit $start ,$length");
        $count_result = DB::select("SELECT count(*) as total FROM patients WHERE 1 $additional_query ");

        $recordsTotal = $count_result[0]->total;
        $recordsFiltered = $recordsTotal; //by default its equal to total record when no search applied

        $output = array();
        foreach ($patients as $item) {
            $id = $item->id;
            $phone = $item->phone_number;
            $view_button = "<a href='patient/show/$id' class='btn btn-info'>Info</a>";
            $edit_button = "<a href='patient/edit/$id' class='btn btn-info'>Edit</a>";
            $delete_button = "<a href='patient/delete/$id' class='badge badge-danger'>Delete</a>";
            $showInfo = "<a href='patient/showInfo/$phone' class='btn btn-info'>History</a>";
            $output[] = array(
                $item->name, $item->phone_number, $item->sex, $item->age, $item->location, $item->occupation,
                $item->unique_id, "$view_button&nbsp;&nbsp$edit_button&nbsp;&nbsp$showInfo&nbsp;&nbsp;"
            );
        }

        $json_data = array(
            "draw"            => $draw,
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data"            => $output   // total data array
        );
        echo json_encode($json_data);
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
        $patient->created_at = Carbon::now();
        // $patient->created_date = Carbon::today();
        $patient->unique_id = rand(100000, 999999);
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
