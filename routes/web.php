<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CallChecklist\Tier2Controller;
use App\Http\Controllers\CallChecklist\shojonTierThree;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('success', function () {
    return view('success');
})->name('success');

/*Route::get('login','Auth\LoginController@showLoginForm');
Route::post('login','Auth\LoginController@login');*/

Auth::routes();

Route::group(['prefix' => 'call-checklist'], function () {


    Route::get('/pupup', 'CallChecklist\ShojonController@pupup')->name('call_checklist.shojon.pupup');


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
        Route::get('create', 'CallChecklist\ShojonController@create')->name('call_checklist.shojon.create');
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
            //tire 2 route 
            Route::get('/add_patient',[Tier2Controller::class,'tire2fromblade'])->name('call_checklist.shojon.tier2');

            Route::post('store/patient', [Tier2Controller::class ,'store'])->name('call_checklist.shojontier2.store');
  
            Route::get('/patientList',[Tier2Controller::class,'tire2patientlist'])->name('call_checklist.shojon.Patientlist');
            Route::post('/submit',[Tier2Controller::class,'TerminationSave_form'])->name('call_checklist.shojon.termination_form');
            Route::post('/referral_t_two',[Tier2Controller::class,'ReferralSave_form'])->name('call_checklist.shojon.Referral_form');
            //Shojon tier Three route  call_checklist.shojontierThree.store
            Route::get('/add_patientt3',[shojonTierThree::class,'tireThreefromblade'])->name('call_checklist.shojon.tierThree');
            Route::post('store_tier3', [shojonTierThree::class ,'store'])->name('call_checklist.shojontierThree.store');
            Route::get('/patientListt3',[shojonTierThree::class,'tireThreepatientlist'])->name('call_checklist.shojon.TierThreePatientlist');
            ///test route
            // Route::post('/referral_t_three',[shojonTierThree::class,'tireThreerelerral_save_data'])->name('call_checklist.shojon.Referral_form');

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
