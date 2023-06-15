<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Null_;
use App\Http\Controllers\Controller;
use FontLib\Table\Type\post;
use App\Models\Referral;
use App\Models\Appointment;
use App\Models\Session;

class UserController extends Controller
{
    public $image = '';
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $user =  DB::table('vicidial_users')
            ->where('user_id', '=', $user_id)
            ->get();
        $referrals = DB::table('referrals')
            ->where('referred_therapist_or_psychiatrist_user_id', '=', $user_id)
            ->where('appointment_status', '=', 0)
            ->orderBy('id', 'DESC')
            ->get();
        $sessions = DB::table('sessions')
            ->where('therapist_or_psychiatrist_user_id', '=', $user_id)
            ->where('session_taken', '=', 'NO')
            ->where('canceled', '=', 'NO')
            ->orderBy('id', 'DESC')
            ->get();
        $rescheduleOrCancelations = DB::table('reschedule_or_cancelations')
            ->where('therapist_or_psychiatrist_user_id', '=', $user_id)
            ->where('status', '=', 'NOT DONE')
            ->get();
        // $patients = DB::select("SELECT patients.* FROM sessions, patients WHERE therapist_or_psychiatrist_user_id = $user_id and patients.unique_id = sessions.unique_id ORDER BY sessions.id;");
        $patients = DB::select("SELECT DISTINCT patients.* FROM sessions, patients WHERE therapist_or_psychiatrist_user_id = $user_id and patients.unique_id = sessions.unique_id ORDER BY sessions.id;");
        // dd($patients);
        return view('call_checklist.shojon.user.show', compact('user', 'referrals', 'sessions', 'patients', 'rescheduleOrCancelations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        // $user_id = $id;
        // $user = User::find($user_id);
        $user =  DB::table('vicidial_users')
            ->where('user_id', '=', $user_id)
            ->get();
        // $user = DB::select("SELECT * FROM `vicidial_users` where `user_id` = $id");

        // dd($user);
        return view('call_checklist.shojon.user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        // dd($request);
        global $image;
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            // 'email' => ['string', 'email', 'max:255', 'unique:vicidial_users'],
            'pass' => ['required', 'string', 'min:8'],
            'designation' => ['string', 'max:255', 'nullable'],
            'gender' => ['string', 'max:15', 'nullable'],
            'age' => ['numeric', 'max:110', 'nullable'],
            'contact_number' => ['numeric', 'max:99999999999'],
            'job_location' => ['string', 'max:255', 'nullable'],
            'bmdc_reg_number' => ['string', 'max:255', 'nullable'],
        ]);
        // Post::where('id', 3)->$data = array();
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('Image/Profile'), $filename);
        }

        if ($request->file('e_signature')) {
            $file = $request->file('e_signature');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('Image/e_signature'), $filename);
        }

        // if ($request->image) {
        //     $image = $request->image;
        // }

        // $full_name = $request->full_name;
        // $user_name = $request->user;
        // $pass = $request->client_name;
        // $user_group = $request->user_group;

        // $data = array('image' => $image, "full_name" => $full_name, "user" => $user_name, "user_group" => $user_group);

        // $user = User::find($user_id);
        // $user = User::whereUserId($user_id)->get();
        $user = User::where('user_id', $user_id)->first();
        // dd($user);
        if ($request->email != '' && $user->email != $request->email) {
            $request->validate([
                'email' => ['string', 'email', 'max:255', 'unique:vicidial_users'],
            ]);
        }

        $data = $request->only($user->getFillable());
        if ($request->file('image')) {
            $data['image'] = date('YmdHi') . $data['image']->getClientOriginalName();
        }
        if ($request->file('e_signature')) {
            $data['e_signature'] = date('YmdHi') . $data['e_signature']->getClientOriginalName();
        }
        // print_r($data['name'], '\n');
        // dd($data);
        // $name = $data['name'];
        // $rowPass = $data['password'];
        // if ($data['password'] != '') {
        //     print($data['password']);
        //     echo '</br>';
        //     // $data['password'] =  Hash::make($request->password);
        //     $options = [
        //         'cost' => 10,
        //     ];
        //     $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT, $options);
        //     print_r($data['password']);
        //     echo '</br>';

        //     // echo password_hash($data['password'], PASSWORD_BCRYPT, $options);
        // } else {
        //     unset($data['password']);
        // }
        $user->fill($data);
        $user->save();

        session()->flash('success', 'User credentials changed successfully !!');
        // redirect('/edit/{{$id}}');
        return redirect()->to('edit/' . $user_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
