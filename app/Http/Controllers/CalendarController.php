<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index()
    {
        $events = array();

        // $user_id =  Auth::user()->user_id;
        // $sessions = DB::table('sessions')
        //     ->where('therapist_or_psychiatrist_user_id', '=', $user_id)
        //     ->orderBy('id', 'DESC')
        //     ->get();
        $sessions = Session::all();

        foreach ($sessions as $session) {
            $color = null;
            if ($session->referr_from == 'Shojon Tier 2') {
                $color = '#99ccff';
            }
            if ($session->referr_from == 'Shojon Tier 3') {
                $color = '#b3b3cc';
            }
            if ($session->referr_from == 'Shojon Tier 1') {
                $color = '#80ffd4';
            }

            $date = $session->session_date . $session->session_time;
            $events[] = [

                'title' => $session->name,
                'start' => $session->created_at,
                'end' => $session->created_at,
                'color' => $color
            ];
        }
        // return $events;
        return view('call_checklist.shojon.calendar.index', ['events' => $events]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string'
        ]);

        $session = Session::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $color = null;

        if ($session->title == 'Test') {
            $color = '#924ACE';
        }

        return response()->json([
            'id' => $session->id,
            'start' => $session->start_date,
            'end' => $session->end_date,
            'title' => $session->title,
            'color' => $color ? $color : '',

        ]);
    }
    public function update(Request $request, $id)
    {
        $session = Session::find($id);
        if (!$session) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $session->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return response()->json('Event updated');
    }
    public function destroy($id)
    {
        $session = Session::find($id);
        if (!$session) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $session->delete();
        return $id;
    }
}
