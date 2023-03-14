<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CallChecklist\Tier2Controller;
use App\Http\Controllers\CallChecklist\shojonTierThree;
use App\Http\Controllers\CallChecklist\TierOneController;
use App\Http\Controllers\CallChecklist\EvaluationController;
use App\Http\Controllers\Patient\PatientController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('success', function () {
    return view('success');
})->name('success');

/*Route::get('login','Auth\LoginController@showLoginForm');
Route::post('login','Auth\LoginController@login');*/
Route::get('/tier_two/add_patient/{user_id}/{session_id}', [Tier2Controller::class, 'tire2fromblade'])->name('call_checklist.shojon.tier2.create')->middleware('auth');
Route::post('/tier_two/store/patient', [Tier2Controller::class, 'store'])->name('call_checklist.shojontier2.store')->middleware('auth');


Route::get('/tier_three/add_patientt3/{user_id}/{session_id}', [shojonTierThree::class, 'tireThreefromblade'])->name('call_checklist.shojon.tierThree.create')->middleware('auth');
Route::post('/tier_three/store_tier3', [shojonTierThree::class, 'store'])->name('call_checklist.shojontierThree.store')->middleware('auth');

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
// Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');

Route::get('users', 'Auth\RegisterController@showAllUser')->name('users')->middleware('auth');
Route::get('/show/{user_id}', 'Auth\UserController@show')->name('user.show')->middleware('auth');
Route::get('/edit/{user_id}', 'Auth\UserController@edit')->name('user.edit')->middleware('auth');
Route::post('/edit/{user_id}', 'Auth\UserController@update')->name('user.update')->middleware('auth');


Auth::routes();

Route::get('/uniqueid', [TierOneController::class, 'uniqueId']);
//Route::get('/add_patient', [Tier2Controller::class, 'tire2fromblade'])

// patient Routes
Route::get('generate-pdf-patient/{query}', 'Patient\PatientController@generatePDF')->name('pdf.patient');
Route::group(['prefix' => 'patient'], function () {
    //Route::get('', 'CallChecklist\PatientController@pupup');
    Route::get('/popup/{number}', [PatientController::class, 'pupup'])->name('patient.popup')->middleware('auth');
    Route::get('/livesearch', [PatientController::class, 'searchExisting'])->middleware('auth');
    Route::get('/cilent_call', [PatientController::class, 'cilent_calls'])->name('patient.cilent_call')->middleware('auth');
    Route::get('/cilent_call_Number', [PatientController::class, 'allcilent_calls_number'])->middleware('auth');
    Route::get('/create/{number}', [PatientController::class, 'create'])->name('patient.create')->middleware('auth');

    Route::get('/', 'Patient\PatientController@index')->name('patients')->middleware('auth');
    Route::get('/show/{unique_id}', 'Patient\PatientController@show')->name('patient.show')->middleware('auth');
    Route::get('/showInfo/{phone}', 'Patient\PatientController@showInfo')->name('patient.showInfo')->middleware('auth');
    Route::get('/paging', 'Patient\PatientController@paging')->name('patient.paging')->middleware('auth');
    Route::get('/search', 'Patient\PatientController@search')->name('patient.search')->middleware('auth');


    Route::get('/edit/{id}', 'Patient\PatientController@edit')->name('patient.edit');
    Route::post('/create', 'Patient\PatientController@store')->name('patient.store');
    Route::post('/edit/{id}', 'Patient\PatientController@update')->name('patient.update');
    Route::get('/delete/{id}', 'Patient\PatientController@delete')->name('patient.delete');
});

// Referral Routes
Route::get('generate-pdf-referral/{query}', 'Patient\PatientController@generatePDF')->name('pdf.patient');
Route::group(['prefix' => 'referral'], function () {
    Route::get('/', 'Referral\ReferralController@index')->name('referrals')->middleware('auth');
    Route::get('/show/{id}', 'Referral\ReferralController@show')->name('referral.show')->middleware('auth');
    Route::get('/showInfo/{unique_id}/{id}', 'Referral\ReferralController@showInfo')->name('referral.showInfo')->middleware('auth');
    Route::get('/paging', 'Referral\ReferralController@paging')->name('referral.paging')->middleware('auth');
    Route::get('/search', 'Referral\ReferralController@search')->name('referral.search')->middleware('auth');

    Route::get('/create', 'Referral\ReferralController@create')->name('referral.create');
    Route::get('/edit/{unique_id}/{id}', 'Referral\ReferralController@edit')->name('referral.edit');
    Route::post('/create', 'Referral\ReferralController@store')->name('referral.store');
    Route::post('/edit/{id}', 'Referral\ReferralController@update')->name('referral.update');
    Route::post('/referConsultant/{id}', 'Referral\ReferralController@referConsultant')->name('referral.referConsultant');
    Route::get('/delete/{id}', 'Referral\ReferralController@delete')->name('referral.delete');
});

// Session Routes
Route::get('generate-pdf-session/{query}', 'Patient\PatientController@generatePDF')->name('pdf.patient');
Route::group(['prefix' => 'session'], function () {
    Route::get('/', 'Session\SessionController@index')->name('sessions')->middleware('auth');
    Route::get('/show/{id}', 'Session\SessionController@show')->name('session.show')->middleware('auth');
    Route::get('/showInfo/{unique_id}/{id}', 'Session\SessionController@showInfo')->name('session.showInfo')->middleware('auth');
    Route::get('/paging', 'Session\SessionController@paging')->name('session.paging')->middleware('auth');
    Route::get('/search', 'Session\SessionController@search')->name('session.search')->middleware('auth');

    Route::get('/create/{unique_id}/{id}', 'Session\SessionController@create')->name('session.create');
    Route::get('/edit/{unique_id}/{id}', 'Session\SessionController@edit')->name('session.edit');
    Route::post('/create/{unique_id}/{id}', 'Session\SessionController@store')->name('session.store');
    Route::post('/edit/{id}', 'Session\SessionController@update')->name('session.update');
    Route::post('/referConsultant/{id}', 'Session\SessionController@referConsultant')->name('session.referConsultant');
    Route::get('/delete/{id}', 'Session\SessionController@delete')->name('session.delete');

    Route::get('/reschedule/cancelation/{number}', 'Session\SessionController@sessionRescheduleCancelationForm')->name('session.rescheduleOrCancelationForm');
    Route::post('/reschedule/cancelation/', 'Session\SessionController@sessionRescheduleCancelationStore')->name('session.rescheduleOrCancelationStore');
    Route::get('/reschedule/cancelation/', 'Session\SessionController@sessionRescheduleCancelation')->name('session.rescheduleOrCancelations');
    Route::get('/reschedule/cancelation/show/{id}', 'Session\SessionController@sessionRescheduleCancelationShow')->name('session.sessionRescheduleCancelationShow');

    Route::post('/reschedule/cancelation/', 'Session\SessionController@sessionRescheduleCancelationStore')->name('session.rescheduleOrCancelationStore');
    Route::get('/reschedule/cancelation/', 'Session\SessionController@sessionRescheduleCancelation')->name('session.rescheduleOrCancelations');
});

// Calendar routes
Route::get('calendar/index', 'CalendarController@index')->name('calendar.index');



Route::group(['prefix' => 'call-checklist'], function () {

    Route::group(['middleware' => 'super_admin'], function () {
        Route::get('index', 'CallChecklist\KprController@index')->name('call_checklist.kpr.index'); // same as /call-checklist/kpr/index
    });


    Route::group(['prefix' => 'kpr'], function () {

        // open for asterisk and all
        Route::get('create/{referrence_id}/{phone?}', 'CallChecklist\KprController@create')->name('call_checklist.kpr.create'); // Same as /call-checklist/kpr/create
        Route::post('store', 'CallChecklist\KprController@store')->name('call_checklist.kpr.store');

        Route::group(['middleware' => 'auth.kpr'], function () {

            Route::get('index', 'CallChecklist\KprController@index')->name('call_checklist.kpr.index'); // /call-checklist/kpr/index
            Route::get('/report/excel', 'CallChecklist\KprController@exportExcel')->name('kpr_excel'); // /call-checklist/kpr/report/excel
            Route::get('/report/pdf/{range_type?}', 'CallChecklist\KprController@exportPdf');

            Route::get('create', 'CallChecklist\KprController@create'); // /call-checklist/kpr/create

            Route::group(['middleware' => 'kpr_admin'], function () {
            });
            Route::group(['middleware' => 'kpr_agent'], function () {
            });
        });
    });


    Route::group(['prefix' => 'shojon'], function () {

        Route::get('create/{referrence_id}/{phone_number}', 'CallChecklist\ShojonController@create')->name('call_checklist.shojon.create');
        Route::get('create/{new}', 'CallChecklist\ShojonController@create')->name('call_checklist.shojon.create');

        // Route::get('/psychiatrist/tierOne', [TierOneController::class, 'tireOnemanual'])->name('psychiatrist.tierOne');
        // Route::get('/tierOne/{uniqueid}', 'CallChecklist\ShojonController@tireOnefromblade')->name('psychiatrist.tierOne');
        // Route::get('create', function () {
        //     echo '------test';
        // })->name('call_checklist.shojon.create');
        Route::post('store', 'CallChecklist\ShojonController@store')->name('call_checklist.shojon.store');
        Route::resource('questionair', 'QuestionairController');


        Route::group(['middleware' => 'auth.shojon'], function () {
            Route::get('index', 'CallChecklist\ShojonController@index')->name('call_checklist.shojon.index');
            Route::get('/report/excel', 'CallChecklist\ShojonController@exportExcel')->name('shojon_excel');
            Route::get('/report/pdf/{range_type?}', 'CallChecklist\ShojonController@exportPdf');

            Route::get('dashboard', 'CallChecklist\KprController@dashboard')->name('call_checklist.kpr.dashboard');

            Route::get('admin/dashboard', 'CallChecklist\ShojonController@dashboard')->name('call_checklist.shojon.admin.dashboard');
            Route::get('doctor/dashboard', 'DashboardController@doctorDashboard')->name('call_checklist.shojon.doctor.dashboard');
            Route::get('supervisor/dashboard', 'DashboardController@supervisorDashboard')->name('call_checklist.shojon.supervisor.dashboard');

            //call evaluation
            Route::get('/evaluationTable', [EvaluationController::class, 'evaluationTable'])->name('call_checklist.shojon.evaluationTable');
            Route::get('/evaluationExcel', [EvaluationController::class, 'evaluationExcel'])->name('call_checklist.shojon.evaluationExcel');
            Route::get('/evaluation', [EvaluationController::class, 'callEvaluationblade'])->name('call_checklist.shojon.callEvaluation');
            Route::post('/evaluation-sote', [EvaluationController::class, 'store'])->name('call_checklist.evaluation.store');
            Route::get('/eva-list', [EvaluationController::class, 'callEvaluationIndex'])->name('call_checklist.shojon.eva_index');
            Route::get('/evaluation-details/{id}', [EvaluationController::class, 'evaluationDetails'])->name('call_checklist.shojon.evaluationdetalis');
            //tire 1 route
            Route::get('/tierOne/dashboard', [TierOneController::class, 'dashboard'])->name('call_checklist.shojon.tierOne.dashboard');

            Route::get('/tierOne/{uniqueid}', [TierOneController::class, 'tireOnefromblade'])->name('call_checklist.shojon.tierOne');
            Route::get('/tierOne', [TierOneController::class, 'tireOnemanual'])->name('call_checklist.shojon.manual_form');

            Route::post('/store/tierOne', [TierOneController::class, 'store_tier_One'])->name('call_checklist.shojontierOne.store_tier_one');
            Route::get('/tierOne_list', [TierOneController::class, 'tireOneList'])->name('call_checklist.shojon.TierOneList');

            Route::get('/tier-one-details/{id}', [TierOneController::class, 'TierOneClientDetails'])->name('call_checklist.shojon.TierOneview');
            Route::get('/tier-one-edit/{caller_id}', [TierOneController::class, 'TierOneclientUpdate'])->name('call_checklist.shojon.TierOneedit');
            Route::post('/tier-One-update', [TierOneController::class, 'TierOneUpdate'])->name('call_checklist.shojon.tierOne_update');

            Route::get('/referral_table', [TierOneController::class, 'referral_table']);
            // Route::get('/termination_table', [TierOneController::class, 'termination_table']);

            //tire 2 route 
            Route::get('/add_patient', [Tier2Controller::class, 'tire2fromblade'])->name('call_checklist.shojon.tier2');

            // Route::post('store/patient', [Tier2Controller::class, 'store'])->name('call_checklist.shojontier2.store');

            Route::get('/patientList', [Tier2Controller::class, 'tire2patientlist'])->name('call_checklist.shojon.Patientlist');
            Route::get('/details-tier-two/{id}', [Tier2Controller::class, 'clientDetailsTierTwo'])->name('shojon.tireTwo.view');
            Route::get('/edit-tier-two/{id}', [Tier2Controller::class, 'clientUpdateTierTwo'])->name('shojon.tireTwo.edit');
            Route::post('/update-tier-two', [Tier2Controller::class, 'TierTwoUpdate'])->name('tierTwo.update');
            Route::post('/submit', [Tier2Controller::class, 'TerminationSave_form'])->name('call_checklist.shojon.termination_form');
            Route::get('/referral_t_two', [Tier2Controller::class, 'ReferralSave_form'])->name('call_checklist.shojon.Referral_form');
            //Shojon tier two report route
            Route::get('/tierTow-report', [Tier2Controller::class, 'tierTow_report'])->name('shojonTierTow.report.picker');
            Route::get('/referral_table_t2', [Tier2Controller::class, 'referral_table']);
            Route::get('/termination_table_t2', [Tier2Controller::class, 'termination_table']);
            //Shojon tier Three route  call_checklist.shojontierThree.store
            Route::get('/add_patientt3', [shojonTierThree::class, 'tireThreefromblade'])->name('call_checklist.shojon.tierThree');
            // Route::post('store_tier3', [shojonTierThree::class, 'store'])->name('call_checklist.shojontierThree.store');
            Route::get('/tierThreeList', [shojonTierThree::class, 'tireThreeList'])->name('shojon.tierThreeList');
            Route::get('/details/{id}', [shojonTierThree::class, 'clientDetails'])->name('shojon.tireThree.view');
            Route::get('/edit/{id}', [shojonTierThree::class, 'clientUpdate'])->name('shojon.tireThree.edit');
            Route::post('/update', [shojonTierThree::class, 'TierTwoUpdate'])->name('shojon.tireThree.update');

            ///test route

            // Route::get('/user/info',[AygasController::class,'userInfo'])->name('user.info');
            // Route::get('dashboard', function()call_checklist.shojon.Patientlist
            // {
            //     echo " test ------------";
            // })->name('call_checklist.kpr.dashboard');

            Route::group(['middleware' => 'shojon_admin'], function () {
            });

            Route::group(['middleware' => 'shojon_agent'], function () {
            });
        });
    });

    Route::get('sms_test/{message}/{phone_number}', 'CallChecklist\ShojonController@sendSms');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
