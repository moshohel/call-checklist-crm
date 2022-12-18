<?php

namespace App\Http\Controllers;

use App\Models\Session;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index()
    {
        $events = array();

        $user_group =  Auth::user()->user_group;
        $user_id =  Auth::user()->user;
        // print_r($user_id);
        if ($user_group == "Psychiatrist" || $user_group == "Therapist") {
            // $user_id = Auth::user()->user;
            $sessions = DB::table('sessions')
                ->where('therapist_or_psychiatrist_user_name', '=', Auth::user()->user)
                ->orderBy('id', 'DESC')
                ->get();
            // ->toSql();
            // print_r($sessions);
            // dd($sessions);
        } else {

            $sessions = Session::all();
        }

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

            // $date = $session->session_date . $session->session_time;
            $date = $session->session_date;
            $time = $session->session_time;
            $end_time = date('H:i:s', strtotime("$time"));
            // dd($end_time);
            $start = date('Y-m-d H:i:s', strtotime("$date $time"));


            $forty_minutes = '00:40:00';
            $time_forty_minutes_added = strtotime($end_time) + strtotime($forty_minutes) - strtotime('00:00:00');
            // dd($time_forty_minutes_added);

            $end = date("Y-m-d H:i:s", strtotime("$session->session_date $time_forty_minutes_added"));
            // dd($end);
            $events[] = [

                'title' => $session->name,
                'start' => $start,
                // 'start' => $session->created_at,
                'end' => $end,
                'color' => $color
            ];
        }
        // return $events;
        return view('call_checklist.shojon.calendar.index', ['events' => $events]);
    }
}
