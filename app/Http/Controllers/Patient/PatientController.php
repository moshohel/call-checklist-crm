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
use App\Models\Unique;
use App\Models\ShojonTierOne;
use App\Models\Cilent_call;
use App\Models\Reassign_request;

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
            $unique_id = $item->unique_id;
            $view_button = "<a href='patient/show/$unique_id' class='btn btn-info m-1'>Actions</a>";
            // $tier_two = "<a href='#' class='btn btn-info' data-toggle='modal' data-target='#ReferralModal'>R-Tier 2</a>";
            // $tier_three = "<a href='#' class='btn btn-info' data-toggle='modal' data-target='#ReferralModal'>R-Tier 3</a>";
            $showInfo = "<a href='patient/showInfo/$unique_id' class='btn btn-info m-1'>History</a>";
            $output[] = array(
                $item->name, $item->phone_number, $item->sex, $item->age, $item->location,
                $item->unique_id, "$showInfo&nbsp;&nbsp;$view_button&nbsp;&nbsp;"
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
    public function searchExisting(Request $request)
    {

        if ($request->ajax()) {
            $output = '';

            $data = ShojonTierOne::where('caller_id', 'like', $request->Search . '%')->orWhere('phone_number', 'like', $request->Search . '%')->orWhere('caller_name', 'like', $request->Search . '%')->get();
            if ($data) {
                foreach ($data as $key => $row) {
                    $output .=
                    '<tr>
                    <td>' . $key . '</td>
                    <td>' . $row->caller_id . '</td>
                    <td>' . $row->caller_name . '</td>
                    <td>' . $row->phone_number . '</td>
                    <td>' . $row->age . '</td>
                    <td>' . $row->sex . '</td>
                    <td>' . $row->location . '</td>
                    <td>' . $row->socio_economic . '</td>
                    <td>' . '<a class="btn btn-info m-1" href="' . route('call_checklist.shojon.TierOneedit', $row->caller_id) . '">Last T1</a>' . '</td>
                    <td>' . '<a class="btn btn-info m-1" href="' . route('patient.showInfo', $row->caller_id) . '"> History </a>' . '</td>
                    </tr>
                    ';
                }
                return response()->json($output);
            }
        }
        return view('call_checklist.patient.popup');
    }
    //uniqueGenerator//
    protected function uniqueGenerator($model, $throw, $length, $prefix)
    {
        $data = $model::orderBy('id', 'desc')->first();
        if (!$data) {
            $og_length = $length;
            $last_number = '';
        } else {
            $code = substr($data->$throw, strlen($prefix) + 1);
            $actial_last_number = ($code / 1) * 1;
            $increment_last_number = ((int)$actial_last_number + 1);
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for ($i = 0; $i < $og_length; $i++) {
            $zeros .= "0";
        }
        return $prefix . $zeros . $last_number;
    }
    // new client popup
    public function pupup($number)
    {
        return view('call_checklist.patient.pupup', compact('number'));
    }
    public function cilent_calls(Request $request){
        $data = new Cilent_call;
        $data->number = $request->Number;
        $data->date = date('Y-m-d H:i:s');
        $data->save();
    }
    public function createReassignRequest(Request $request){
        $data = new Reassign_request;
        $data->date = date('Y-m-d H:i:s');
        $data->unique_id = $request->unique_id;
        $data->phone_number = $request->phone_number;
        $data->reason_for_reassing = $request->reason_for_reassing;
        $data->save();
    }
    public function allcilent_calls_number(Request $request){

        if ($request->ajax()) {
            $output = '';
            $data = DB::table('cilent_calls')->orderBy('id', 'DESC')->get();
            if ($data) {
                foreach ($data as $key => $row) {
                    $output .=
                    '<tr>
                    <td class="text-center">' . $key+1 . '</td>
                    <td class="text-center">' . $row->number . '</td>
                    <td class="text-center">' . $row->date . '</td>
                    </tr>';
                }
                return response()->json($output);
            }
        }
    return view('call_checklist.patient.popup');
    }
    // new 
    public function create($number)
    {
        $uniqueId = $this->uniqueGenerator(new Unique, 'unique_id', 6, 'SHO');
        $data = new Unique;
        $data->unique_id = $uniqueId;
        $data->save();
        $getuniqueId = DB::table('uniques')->latest()->first();
        $districts = District::orderBy('name')->pluck('name');
        return view('call_checklist.patient.create', compact('districts', 'getuniqueId', 'number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $patient = new Patient();
        $patient->unique_id = $request->uniqueId;
        $patient->name = $request->name;
        $patient->phone_number = $request->phone_number;
        $patient->sex = $request->sex;
        $patient->age = $request->age;
        $patient->location = $request->location;
        $patient->socio_economic_status = $request->socio_economic_status;
        //$patient->created_at = Carbon::now();
        // $patient->created_date = Carbon::today();
        //dd($patient);
        $patient->save();
        //session()->flash('success', 'New patient has added successfully !!');
        // return redirect()->route('admin.products');
        return redirect()->route('call_checklist.shojon.tierOne', $request->uniqueId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($unique_id)
    {
        // dd($unique_id);
        $patient = DB::table('patients')
        ->where('unique_id', '=', $unique_id)
        ->get();
        // $patient = Patient::distinct()->get(['unique_id']);
        // dd($patient);
        // return view('pages.patient.show')->with('patient', $patient);
        return view('call_checklist.patient.show', compact('patient'));
    }

    public function showInfo($unique_id)
    {
        $pageTitle = $this->pageTitle;
        // dd($phone);
        // $patient = Patient::find($phone);
        $previous_data = null;
        $last = null;

        // $is_phone_no = CallChecklistForShojon::where('phone_number', $phone)->first();
        // if ($is_phone_no) {
        //     $previous_data = CallChecklistForShojon::where('phone_number', $phone)->get();
        // }

        $patient = DB::select("SELECT * FROM `patients` WHERE unique_id = '$unique_id'");
        // $previous_data = DB::select("SELECT * FROM shojon_tier_ones WHERE unique_id = '$unique_id'");
        $previous_data = ShojonTierOne::where('caller_id', '=', $unique_id)->get();

        // $queries = DB::select("SELECT * FROM queries WHERE phone = $phone");
        // dd($previous_data);
        return view('call_checklist.patient.showInfo', compact('pageTitle', 'previous_data', 'patient'));
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
