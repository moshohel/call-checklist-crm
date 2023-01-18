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
Route::get('/add_patient', [Tier2Controller::class, 'tire2fromblade'])->name('call_checklist.shojon.tier2.create');
Route::get('/add_patientt3', [shojonTierThree::class, 'tireThreefromblade'])->name('call_checklist.shojon.tierThree.create');

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
    Route::get('/pupup/{number}', [PatientController::class, 'pupup']);
    Route::get('/livesearch', [PatientController::class, 'searchExisting']);
    Route::get('/create/{number}', [PatientController::class, 'create'])->name('patient.create');

    Route::get('/', 'Patient\PatientController@index')->name('patients')->middleware('auth');
    Route::get('/show/{id}', 'Patient\PatientController@show')->name('patient.show')->middleware('auth');
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
});

// Calendar routes
Route::get('calendar/index', 'CalendarController@index')->name('calendar.index');
Route::post('calendar', [CalendarController::class, 'store'])->name('calendar.store');
Route::patch('calendar/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
Route::delete('calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');


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
            //call evaluation
            Route::get('/evaluation', [EvaluationController::class, 'callEvaluationblade'])->name('call_checklist.shojon.callEvaluation');
            Route::post('/evaluation-sote', [EvaluationController::class, 'store'])->name('call_checklist.evaluation.store');
            Route::get('/eva-list', [EvaluationController::class, 'callEvaluationIndex'])->name('call_checklist.shojon.eva_index');
            Route::get('/evaluation-details/{id}', [EvaluationController::class, 'evaluationDetails'])->name('call_checklist.shojon.evaluationdetalis');
            //tire 1 route

            Route::get('/tierOne', [TierOneController::class, 'tireOnemanual'])->name('call_checklist.shojon.manual_form');

            Route::post('/store/tierOne', [TierOneController::class, 'store_tier_One'])->name('call_checklist.shojontierOne.store_tier_one');
            Route::get('/tierOne_list', [TierOneController::class, 'tireOneList'])->name('call_checklist.shojon.TierOneList');
            Route::get('/tierOne/dashboard', [TierOneController::class, 'dashboard'])->name('call_checklist.shojon.tierOne.dashboard');
            Route::get('/tierOne/{uniqueid}', [TierOneController::class, 'tireOnefromblade'])->name('call_checklist.shojon.tierOne');

            Route::get('/tier-one-details/{id}', [TierOneController::class, 'TierOneClientDetails'])->name('call_checklist.shojon.TierOneview');
            Route::get('/tier-one-edit/{caller_id}', [TierOneController::class, 'TierOneclientUpdate'])->name('call_checklist.shojon.TierOneedit');
            Route::post('/tier-One-update', [TierOneController::class, 'TierOneUpdate'])->name('call_checklist.shojon.tierOne_update');
            Route::get('/tierOne/{uniqueid}', [TierOneController::class, 'tireOnefromblade'])->name('call_checklist.shojon.tierOne');
            //tire 2 route 
            Route::get('/add_patient', [Tier2Controller::class, 'tire2fromblade'])->name('call_checklist.shojon.tier2');

            Route::post('store/patient', [Tier2Controller::class, 'store'])->name('call_checklist.shojontier2.store');

            Route::get('/patientList', [Tier2Controller::class, 'tire2patientlist'])->name('call_checklist.shojon.Patientlist');
            Route::get('/details/{id}', [Tier2Controller::class, 'clientDetails'])->name('shojon.tireTwo.view');
            Route::get('/edit/{id}', [Tier2Controller::class, 'clientUpdate'])->name('shojon.tireTwo.edit');
            Route::post('/update', [Tier2Controller::class, 'TierTwoUpdate'])->name('tierTwo.update');
            Route::post('/submit', [Tier2Controller::class, 'TerminationSave_form'])->name('call_checklist.shojon.termination_form');
            Route::get('/referral_t_two', [Tier2Controller::class, 'ReferralSave_form'])->name('call_checklist.shojon.Referral_form');
            //Shojon tier Three route  call_checklist.shojontierThree.store
            Route::get('/add_patientt3', [shojonTierThree::class, 'tireThreefromblade'])->name('call_checklist.shojon.tierThree');
            Route::post('store_tier3', [shojonTierThree::class, 'store'])->name('call_checklist.shojontierThree.store');
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
