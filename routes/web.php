<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('success', function () {
    return view('success');
})->name('success');

/*Route::get('login','Auth\LoginController@showLoginForm');
Route::post('login','Auth\LoginController@login');*/

Auth::routes();

// patient Routes
Route::get('generate-pdf-patient/{query}', 'Patient\PatientController@generatePDF')->name('pdf.patient');
Route::group(['prefix' => 'patient'], function () {
    Route::get('/', 'Patient\PatientController@index')->name('patients')->middleware('auth');
    Route::get('/show/{id}', 'Patient\PatientController@show')->name('patient.show')->middleware('auth');
    Route::get('/showInfo/{phone}', 'Patient\PatientController@showInfo')->name('patient.showInfo')->middleware('auth');
    Route::post('/paging', 'Patient\PatientController@paging')->name('patient.paging')->middleware('auth');
    Route::post('/search', 'Patient\PatientController@search')->name('patient.search')->middleware('auth');

    Route::get('/create', 'Patient\PatientController@create')->name('patient.create');
    Route::get('/edit/{id}', 'Patient\PatientController@edit')->name('patient.edit');
    Route::post('/create', 'Patient\PatientController@store')->name('patient.store');
    Route::post('/edit/{id}', 'Patient\PatientController@update')->name('patient.update');
    Route::get('/delete/{id}', 'Patient\PatientController@delete')->name('patient.delete');
});

Route::group(['prefix' => 'call-checklist'], function () {


    Route::get('/pupup/{number}', 'CallChecklist\ShojonController@pupup')->name('call_checklist.shojon.pupup');


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
            // Route::get('dashboard', function()
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
