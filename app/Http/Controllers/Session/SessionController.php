<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referral;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Session;
use Illuminate\Support\Facades\Auth;

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
        // dd($request);
        $session = new Session();

        $data = $request->only($session->getFillable());

        $session->fill($data);
        $session->referred_therapist_or_psychiatrist_user_id = Auth::user()->user_id;
        $session->referred_therapist_or_psychiatrist = Auth::user()->full_name;
        $session->referred_therapist_or_psychiatrist_user_name = Auth::user()->user;

        $session->save();

        $user_id = Auth::user()->user_id;
        return redirect()->to('show/' . $user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
