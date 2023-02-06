<?php

namespace App\Http\Controllers;

use App\Exports\ShojonCallChecklistExport;
use App\Http\Controllers\Controller;
use App\Models\CallChecklistForShojon;
use App\Models\District;
use App\Models\ShojonMainReasonForCalling;
use App\Models\ShojonMentalIllnessDiagnosis;
use App\Models\ShojonSecondaryReasonForCalling;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use Svg\Tag\Rect;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function doctorDashboard(Request $request)
    {
        $start_time = "2022-01-25";
        $end_time = "2022-04-22";
        // dd($request);

        // if ($request->start_time == null || $request->end_time == null) {
        //     $end_time = Carbon::now()->format('Y-m-d');
        //     $start_time = Carbon::now()->subDays(7)->format('Y-m-d');
        // }

        // if ($request->start_time && $request->end_time) {
        //     $start_time = $request->start_time;
        //     $end_time = $request->end_time;
        // }
        $pageTitle = "Doctor - Dashboard";

        $call_type = DB::select("select
        count(case when call_type='Hang up call'  then 1 end) as hang_up_call,
        count(case when call_type='Received Service'  then 1 end) as received_service,
        count(case when call_type='Information related call'  then 1 end) as information,
        count(case when call_type='Inappropriate Call'  then 1 end) as inappropriate,
        count(case when call_type='Silent Call'  then 1 end) as silent_calls,
        count(*) as total_cnt 
        from call_checklist_for_shojon
        where (DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time');");

        $sex_cnt = DB::select("select count(case when sex='Male'  then 1 end) as male_cnt, 
        count(case when sex='Female'  then 1 end) as female_cnt, count(*) as total_cnt 
        from call_checklist_for_shojon where (DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time');");

        $call_age = DB::select("select count(case when age='13-19'  then 1 end) as age13_19, 
        count(case when age='20-30'  then 1 end) as age20_30, 
        count(case when age='31-40'  then 1 end) as age31_40, 
        count(case when age='41-65'  then 1 end) as age40_65
        from call_checklist_for_shojon where (DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time');");

        $ref_cnt = DB::select("select  
        count(case when client_referral ='SHOJON Tier 2 for Psychotherapy'  then 1 end) as ref_no_tier2,
        count(case when client_referral ='SHOJON Tier 3 for Psychiatric Consultation'  then 1 end) as ref_no_tier3
        from call_checklist_for_shojon where (DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time');");
        // echo gettype($ref_cnt[0])."\n";
        // dd($ref_cnt[0]);

        $hearing_source = DB::select("select
        count(case when hearing_source='Social Media'  then 1 end) as social_medial,
        count(case when hearing_source='Word of mouth'  then 1 end) as word_of_mouth,
        count(case when hearing_source='Shojon Counselor'  then 1 end) as shojon_counselor,
        count(case when hearing_source='Don\'t know'  then 1 end) as dont_know,
        count(case when hearing_source='From his friend'  then 1 end) as friend

        from call_checklist_for_shojon
        where (DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time');");

        $financial = DB::select("SELECT CAST(ref_financial_affort AS UNSIGNED) as afford, ref_financial_affort FROM 
        `call_checklist_for_shojon` where DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time' and ref_financial_affort IS NOT NULL;");
        // dd($financial);

        // $total_call_cnt = DB::select("select count(*)
        // as total_calls from  call_log c left join vicidial_closer_log cl on c.uniqueid=cl.uniqueid
        // where 1 and c.number_dialed='09612119900' 
        // and (DATE(start_time) >= '$start_time' and DATE(start_time) <= '$end_time');");

        $total_call_cnt = DB::select("select count(*) as total_calls
        from 
        (
        SELECT vl.status 
        from vicidial_users vu,vicidial_closer_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('AGENTDIRECT','AGENTDIRECT_CHAT','SHOJON_In')  
        
        union all
        
        SELECT vl.status 
        from vicidial_users vu,vicidial_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('SHOJON') 
        ) A ");


        $afther_call = DB::select("select count(*) as total_calls
        from 
        (
        SELECT vl.status 
        from vicidial_users vu,vicidial_closer_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('AGENTDIRECT','AGENTDIRECT_CHAT','SHOJON_In')  
        
        union all
        
        SELECT vl.status 
        from vicidial_users vu,vicidial_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('SHOJON') 
        ) A 
        where A.status='AFTHRS';");


        $drop_call = DB::select("select count(*) as total_calls
        from 
        (
        SELECT vl.status 
        from vicidial_users vu,vicidial_closer_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('AGENTDIRECT','AGENTDIRECT_CHAT','SHOJON_In')  
        
        union all
        
        SELECT vl.status 
        from vicidial_users vu,vicidial_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('SHOJON') 
        ) A 
        where A.status='DROP';");


        $time_out = DB::select("select count(*) as total_calls from 
        (
        SELECT vl.status 
        from vicidial_users vu,vicidial_closer_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('AGENTDIRECT','AGENTDIRECT_CHAT','SHOJON_In')  
        
        union all
        
        SELECT vl.status 
        from vicidial_users vu,vicidial_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('SHOJON') 
        ) A 
        
        where A.status='TIMEOT';");

        $recived_call = DB::select("select count(*) as total_calls from 
        (
        SELECT vl.user 
        from vicidial_users vu,vicidial_closer_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('AGENTDIRECT','AGENTDIRECT_CHAT','SHOJON_In')  
        
        union all
        
        SELECT vl.user
        from vicidial_users vu,vicidial_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('SHOJON') 
        ) A 
        
        where A.user!='VDCL';");
        // dd($recived_call);
        // dd($dropp_call->total_calls);

        $INTIMECALL = ($total_call_cnt[0]->total_calls - $afther_call[0]->total_calls);
        $afther_call = $afther_call[0]->total_calls;
        $drop_call = $drop_call[0]->total_calls;
        $time_out = $time_out[0]->total_calls;
        $recived_call = $recived_call[0]->total_calls;
        $call_status[0] = $INTIMECALL;
        $call_status[1] = $afther_call;
        $call_status[2] = $drop_call;
        $call_status[3] = $time_out;
        $call_status[4] = $recived_call;
        //    dd($call_status);

        $lessThenFiftyOne = 0;
        $lessThenHunderdOne = 0;
        $biggerThenHunderdOne = 0;
        foreach ($financial as $x) {
            // echo "$x <br>";

            if ($x->afford > 0 and $x->afford <= 50) {
                $lessThenFiftyOne++;
                // print_r('---------------',  $lessThenFiftyOne)."\n";
                // echo $x->afford . "----- less Then FiftyOne----- "  . $lessThenFiftyOne . "<br>";

            }
            if ($x->afford <= 100 and $x->afford > 50) {
                $lessThenHunderdOne++;
                // print_r('---------------',  $lessThenHunderdOne)."\n";
                // echo $x->afford . "-----less Then HunderdOn----- " .$lessThenHunderdOne . "<br>";
            }
            if ($x->afford > 100) {
                $biggerThenHunderdOne++;
                // print_r('---------------',  $biggerThenHunderdOne)."\n";
                // echo $x->afford . "-----bigger Then HunderdOne----- " . $biggerThenHunderdOne . "<br>";
            }
            // print_r('---------------')."\n";
        };


        // echo "lessThenFiftyOne -" . $lessThenFiftyOne . "<br>";
        // echo "lessThenHunderdOne -" . $lessThenHunderdOne . "<br>";
        // echo "biggerThenHunderdOne -" . $biggerThenHunderdOne . "<br>";
        $total_num = $lessThenFiftyOne + $lessThenHunderdOne + $biggerThenHunderdOne;
        // printf($total_num);
        if ($total_num == 0) {
            $total_num = 1;
        }
        $lessThenFiftyOne = round(($lessThenFiftyOne * 100) / $total_num);
        $lessThenHunderdOne = round(($lessThenHunderdOne * 100) / $total_num);
        $biggerThenHunderdOne = round(($biggerThenHunderdOne * 100) / $total_num);
        // echo "lessThenFiftyOne -" . $lessThenFiftyOne . "<br>";
        // echo "lessThenHunderdOne -" . $lessThenHunderdOne . "<br>";
        // echo "biggerThenHunderdOne -" . $biggerThenHunderdOne . "<br>";
        $financial_aff[0] = $lessThenFiftyOne;
        $financial_aff[1] = $lessThenHunderdOne;
        $financial_aff[2] = $biggerThenHunderdOne;

        // dd($financial);
        // echo gettype($financial)."\n";
        // dd($financial[0]->ref_financial_affort, $financial[0]->afford);




        $total_cnt = $call_type[0]->total_cnt;
        $total_call_cnt = $total_call_cnt[0]->total_calls;
        $call_type = json_encode($call_type[0]);
        $sex_cnt = json_encode($sex_cnt);
        $call_age = json_encode($call_age[0]);
        $hearing_source = json_encode($hearing_source[0]);
        $call_status = json_encode($call_status);
        $financial_aff = json_encode($financial_aff);
        $ref_cnt_tier2 = $ref_cnt[0]->ref_no_tier2;
        $ref_cnt_tier3 = $ref_cnt[0]->ref_no_tier3;

        return view(
            'call_checklist.shojon.user.doctorDashboard',
            compact(
                'pageTitle',
                'total_call_cnt',
                // 'kprData', 
                // 'data', 
                'sex_cnt',
                'call_type',
                'call_age',
                'total_cnt',
                'ref_cnt_tier2',
                'hearing_source',
                'financial_aff',
                'call_status',
                'ref_cnt_tier3'
            )
        );
    }

    public function supervisorDashboard(Request $request)
    {
        $start_time = "2022-01-25";
        $end_time = "2022-04-22";
        // dd($request);

        // if ($request->start_time == null || $request->end_time == null) {
        //     $end_time = Carbon::now()->format('Y-m-d');
        //     $start_time = Carbon::now()->subDays(7)->format('Y-m-d');
        // }

        // if ($request->start_time && $request->end_time) {
        //     $start_time = $request->start_time;
        //     $end_time = $request->end_time;
        // }

        $pageTitle = "Supervisor Dashboard";

        $call_type = DB::select("select
        count(case when call_type='Hang up call'  then 1 end) as hang_up_call,
        count(case when call_type='Received Service'  then 1 end) as received_service,
        count(case when call_type='Information related call'  then 1 end) as information,
        count(case when call_type='Inappropriate Call'  then 1 end) as inappropriate,
        count(case when call_type='Silent Call'  then 1 end) as silent_calls,
        count(*) as total_cnt 
        from call_checklist_for_shojon
        where (DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time');");

        $sex_cnt = DB::select("select count(case when sex='Male'  then 1 end) as male_cnt, 
        count(case when sex='Female'  then 1 end) as female_cnt, count(*) as total_cnt 
        from call_checklist_for_shojon where (DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time');");

        $call_age = DB::select("select count(case when age='13-19'  then 1 end) as age13_19, 
        count(case when age='20-30'  then 1 end) as age20_30, 
        count(case when age='31-40'  then 1 end) as age31_40, 
        count(case when age='41-65'  then 1 end) as age40_65
        from call_checklist_for_shojon where (DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time');");

        $ref_cnt = DB::select("select  
        count(case when client_referral ='SHOJON Tier 2 for Psychotherapy'  then 1 end) as ref_no_tier2,
        count(case when client_referral ='SHOJON Tier 3 for Psychiatric Consultation'  then 1 end) as ref_no_tier3
        from call_checklist_for_shojon where (DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time');");
        // echo gettype($ref_cnt[0])."\n";
        // dd($ref_cnt[0]);

        $hearing_source = DB::select("select
        count(case when hearing_source='Social Media'  then 1 end) as social_medial,
        count(case when hearing_source='Word of mouth'  then 1 end) as word_of_mouth,
        count(case when hearing_source='Shojon Counselor'  then 1 end) as shojon_counselor,
        count(case when hearing_source='Don\'t know'  then 1 end) as dont_know,
        count(case when hearing_source='From his friend'  then 1 end) as friend

        from call_checklist_for_shojon
        where (DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time');");

        $financial = DB::select("SELECT CAST(ref_financial_affort AS UNSIGNED) as afford, ref_financial_affort FROM 
        `call_checklist_for_shojon` where DATE(created_at) >= '$start_time' and DATE(created_at) <= '$end_time' and ref_financial_affort IS NOT NULL;");
        // dd($financial);

        // $total_call_cnt = DB::select("select count(*)
        // as total_calls from  call_log c left join vicidial_closer_log cl on c.uniqueid=cl.uniqueid
        // where 1 and c.number_dialed='09612119900' 
        // and (DATE(start_time) >= '$start_time' and DATE(start_time) <= '$end_time');");

        $total_call_cnt = DB::select("select count(*) as total_calls
        from 
        (
        SELECT vl.status 
        from vicidial_users vu,vicidial_closer_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('AGENTDIRECT','AGENTDIRECT_CHAT','SHOJON_In')  
        
        union all
        
        SELECT vl.status 
        from vicidial_users vu,vicidial_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('SHOJON') 
        ) A ");


        $afther_call = DB::select("select count(*) as total_calls
        from 
        (
        SELECT vl.status 
        from vicidial_users vu,vicidial_closer_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('AGENTDIRECT','AGENTDIRECT_CHAT','SHOJON_In')  
        
        union all
        
        SELECT vl.status 
        from vicidial_users vu,vicidial_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('SHOJON') 
        ) A 
        where A.status='AFTHRS';");


        $drop_call = DB::select("select count(*) as total_calls
        from 
        (
        SELECT vl.status 
        from vicidial_users vu,vicidial_closer_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('AGENTDIRECT','AGENTDIRECT_CHAT','SHOJON_In')  
        
        union all
        
        SELECT vl.status 
        from vicidial_users vu,vicidial_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('SHOJON') 
        ) A 
        where A.status='DROP';");


        $time_out = DB::select("select count(*) as total_calls from 
        (
        SELECT vl.status 
        from vicidial_users vu,vicidial_closer_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('AGENTDIRECT','AGENTDIRECT_CHAT','SHOJON_In')  
        
        union all
        
        SELECT vl.status 
        from vicidial_users vu,vicidial_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('SHOJON') 
        ) A 
        
        where A.status='TIMEOT';");

        $recived_call = DB::select("select count(*) as total_calls from 
        (
        SELECT vl.user 
        from vicidial_users vu,vicidial_closer_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('AGENTDIRECT','AGENTDIRECT_CHAT','SHOJON_In')  
        
        union all
        
        SELECT vl.user
        from vicidial_users vu,vicidial_log vl,vicidial_list vi 
        where vl.call_date >= '$start_time' and vl.call_date <= '$end_time' 
        and vu.user=vl.user and vi.lead_id=vl.lead_id  and vl.campaign_id IN('SHOJON') 
        ) A 
        
        where A.user!='VDCL';");
        // dd($recived_call);
        // dd($dropp_call->total_calls);

        $INTIMECALL = ($total_call_cnt[0]->total_calls - $afther_call[0]->total_calls);
        $afther_call = $afther_call[0]->total_calls;
        $drop_call = $drop_call[0]->total_calls;
        $time_out = $time_out[0]->total_calls;
        $recived_call = $recived_call[0]->total_calls;
        $call_status[0] = $INTIMECALL;
        $call_status[1] = $afther_call;
        $call_status[2] = $drop_call;
        $call_status[3] = $time_out;
        $call_status[4] = $recived_call;
        //    dd($call_status);

        $lessThenFiftyOne = 0;
        $lessThenHunderdOne = 0;
        $biggerThenHunderdOne = 0;
        foreach ($financial as $x) {
            // echo "$x <br>";

            if ($x->afford > 0 and $x->afford <= 50) {
                $lessThenFiftyOne++;
                // print_r('---------------',  $lessThenFiftyOne)."\n";
                // echo $x->afford . "----- less Then FiftyOne----- "  . $lessThenFiftyOne . "<br>";

            }
            if ($x->afford <= 100 and $x->afford > 50) {
                $lessThenHunderdOne++;
                // print_r('---------------',  $lessThenHunderdOne)."\n";
                // echo $x->afford . "-----less Then HunderdOn----- " .$lessThenHunderdOne . "<br>";
            }
            if ($x->afford > 100) {
                $biggerThenHunderdOne++;
                // print_r('---------------',  $biggerThenHunderdOne)."\n";
                // echo $x->afford . "-----bigger Then HunderdOne----- " . $biggerThenHunderdOne . "<br>";
            }
            // print_r('---------------')."\n";
        };


        // echo "lessThenFiftyOne -" . $lessThenFiftyOne . "<br>";
        // echo "lessThenHunderdOne -" . $lessThenHunderdOne . "<br>";
        // echo "biggerThenHunderdOne -" . $biggerThenHunderdOne . "<br>";
        $total_num = $lessThenFiftyOne + $lessThenHunderdOne + $biggerThenHunderdOne;
        // printf($total_num);
        if ($total_num == 0) {
            $total_num = 1;
        }
        $lessThenFiftyOne = round(($lessThenFiftyOne * 100) / $total_num);
        $lessThenHunderdOne = round(($lessThenHunderdOne * 100) / $total_num);
        $biggerThenHunderdOne = round(($biggerThenHunderdOne * 100) / $total_num);
        // echo "lessThenFiftyOne -" . $lessThenFiftyOne . "<br>";
        // echo "lessThenHunderdOne -" . $lessThenHunderdOne . "<br>";
        // echo "biggerThenHunderdOne -" . $biggerThenHunderdOne . "<br>";
        $financial_aff[0] = $lessThenFiftyOne;
        $financial_aff[1] = $lessThenHunderdOne;
        $financial_aff[2] = $biggerThenHunderdOne;

        // dd($financial);
        // echo gettype($financial)."\n";
        // dd($financial[0]->ref_financial_affort, $financial[0]->afford);




        $total_cnt = $call_type[0]->total_cnt;
        $total_call_cnt = $total_call_cnt[0]->total_calls;
        $call_type = json_encode($call_type[0]);
        $sex_cnt = json_encode($sex_cnt);
        $call_age = json_encode($call_age[0]);
        $hearing_source = json_encode($hearing_source[0]);
        $call_status = json_encode($call_status);
        $financial_aff = json_encode($financial_aff);
        $ref_cnt_tier2 = $ref_cnt[0]->ref_no_tier2;
        $ref_cnt_tier3 = $ref_cnt[0]->ref_no_tier3;

        return view(
            'call_checklist.shojon.user.supervisorDashboard',
            compact(
                'pageTitle',
                'total_call_cnt',
                // 'kprData', 
                // 'data', 
                'sex_cnt',
                'call_type',
                'call_age',
                'total_cnt',
                'ref_cnt_tier2',
                'hearing_source',
                'financial_aff',
                'call_status',
                'ref_cnt_tier3'
            )
        );
    }
}
