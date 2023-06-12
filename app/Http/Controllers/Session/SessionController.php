<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referral;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\RescheduleOrCancelation;
use App\Models\ShojonTierOne;
use Illuminate\Database\Eloquent\Model;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($unique_id, $reffer_id)
    {
        try {
            $referral = DB::table('referrals')->where('id', $reffer_id)->first();
            // dd($referral);
            if ($referral) {
                $previous_data = DB::table('referrals')->where('id', $reffer_id)->get();
                $last = $previous_data->last();
            }

            return view('call_checklist.shojon.session.create', compact('referral', 'previous_data', 'last'));
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
        return view('');

        // $referral = Referral::find($id);
        // return view('call_checklist.shojon.session.create', compact('referral'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $unique_id, $id)
    {
        $session = new Session();
        $data = $request->only($session->getFillable());
        // dd($data);
        $session->fill($data);
        $session->therapist_or_psychiatrist_user_id = Auth::user()->user_id;
        $session->therapist_or_psychiatrist = Auth::user()->full_name;
        $session->therapist_or_psychiatrist_user_name = Auth::user()->user;
        $session->save();

        $referral = Referral::find($id);
        $referral->appointment_status = 1;
        $referral->save();

        $user_id = Auth::user()->user_id;
        return redirect()->to('show/' . $user_id);
    }

    public function update(Request $request, $request_id, $doctor_id)
    {
        $rescheduleOrCancelationRequest = RescheduleOrCancelation::find($request_id);
        // dd($request);
        $unique_id = $rescheduleOrCancelationRequest->unique_id;
        $session = Session::where('unique_id', '=', $unique_id)
            ->where('therapist_or_psychiatrist_user_id', '=', $doctor_id)
            ->where('session_taken', '=', 'NO')
            ->get();
        // ->toSql();
        print_r('doctor id -' . $doctor_id . 'client id - ' . $unique_id);
        dd($session);
        $data = array();
        $data['status'] = "DONE";
        DB::table('reschedule_or_cancelations')->where('id', $request_id)->update($data);
        $d = DB::table('reschedule_or_cancelations')->where('id', $request_id)->get();
        // dd($d);
        return redirect()->back();
        // return redirect('user.show', auth()->user()->user_id);
    }

    public function sessionRescheduleCancelation()
    {
        $rescheduleOrCancelations = DB::table('reschedule_or_cancelations')
            ->join('patients', 'reschedule_or_cancelations.unique_id', '=', 'patients.unique_id')
            ->select('reschedule_or_cancelations.*', 'patients.name')
            ->get();

        // dd($rescheduleOrCancelations);
        // $rescheduleOrCancelations = RescheduleOrCancelation::all();
        return view('call_checklist.shojon.session.rescheduleCancelation.index', compact('rescheduleOrCancelations'));
    }

    public function sessionRescheduleCancelationForm($number)
    {

        $phone_number = $number;
        $consultants = DB::select('SELECT full_name, user_id, user as user_name FROM vicidial_users WHERE user_group="Psychiatrist" or user_group="Therapist"');
        return view('call_checklist.shojon.session.rescheduleCancelation.create', compact('consultants', 'phone_number'));
    }

    public function sessionRescheduleCancelationStore(Request $request)
    {

        $phone_number = $request->phone_number;
        $reff = 0000;
        $unique_id = $request->unique_id;
        $doctor_id = $request->therapist_or_psychiatrist_user_id;

        $session = Session::where('unique_id', '=', $unique_id)
            ->where('therapist_or_psychiatrist_user_id', '=', $doctor_id)
            ->where('session_taken', '=', 'NO')
            ->first();
        // ->toSql();
        // print_r('doctor id -' . $doctor_id . 'client id - ' . $unique_id);
        // dd($session);
        if ($session) {
            // dd($session);
            $rescheduleOrCancelation = new RescheduleOrCancelation();
            $data = $request->only($rescheduleOrCancelation->getFillable());
            $rescheduleOrCancelation->fill($data);
            if ($request->request_type == "Cancelation") {
                $rescheduleOrCancelation->cancelation_request = 1;
            } else {
                $rescheduleOrCancelation->reshedule_request = 1;
            }
            $rescheduleOrCancelation->save();
            $consultants = DB::select('SELECT full_name, user_id, user as user_name FROM vicidial_users WHERE user_group="Psychiatrist" or user_group="Therapist"');
            // return view('call_checklist.shojon.session.rescheduleCancelation.index', compact('consultants'));
            session()->flash('success', 'Request submitted successfully !!');
            return redirect()->route('patient.popup', [$reff, $phone_number]);
        }
        session()->flash('error', 'Client ID or Doctor Name incorrect!!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sessionRescheduleCancelationShow($id)
    {
        $rescheduleOrCancelation = RescheduleOrCancelation::find($id);
        // dd($rescheduleOrCancelation);

        return view('call_checklist.shojon.session.rescheduleCancelation.show', compact('rescheduleOrCancelation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sessionRescheduleFrom($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sessionReschedule(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sessionCancelation($id)
    {
        //
    }
}
