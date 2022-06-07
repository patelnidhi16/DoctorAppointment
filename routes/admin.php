<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Schedule\ScheduleController;
use App\Jobs\Info;
use Illuminate\Support\Facades\Route;


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


Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/queue',function(){
//     dispatch(new Info())->delay(now()); 
//     });
Route::group(['middleware' => 'auth:admin'], function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'doctor', 'as' => "doctor."], function () {
        Route::get('/index', [DoctorController::class, 'index'])->name('index');
        Route::post('/create', [DoctorController::class, 'create'])->name('create');
        Route::get('/delete', [DoctorController::class, 'delete'])->name('delete');
        Route::get('/edit', [DoctorController::class, 'edit'])->name('edit');
    });
    // Route::group(['prefix' => 'appointment', 'as' => "appointment."], function () {
    //     Route::post('/create', [AppointmentController::class, 'create'])->name('create');
    //     Route::get('/getdoctor', [AppointmentController::class, 'getdoctor'])->name('getdoctor');
    //     Route::get('/index', [AppointmentController::class, 'index'])->name('index');
    //     Route::get('/delete', [AppointmentController::class, 'delete'])->name('delete');
    //     Route::get('/edit', [AppointmentController::class, 'edit'])->name('edit');
    //     Route::post('/update', [AppointmentController::class, 'update'])->name('update');
    // });

    Route::group(['prefix' => 'patient', 'as' => "patient."], function () {
        Route::post('/create', [PatientController::class, 'create'])->name('create');
        Route::get('/index', [PatientController::class, 'index'])->name('index');
        Route::get('/delete', [PatientController::class, 'delete'])->name('delete');
        Route::get('/edit', [PatientController::class, 'edit'])->name('edit');
        Route::get('/getdoctorlist', [PatientController::class, 'getdoctorlist'])->name('getdoctorlist');
        
    });
    Route::group(['prefix' => 'schedule', 'as' => "schedule."], function () {
        Route::post('/create', [ScheduleController::class, 'create'])->name('create');
        Route::get('/index', [ScheduleController::class, 'index'])->name('index');
        Route::get('/delete', [ScheduleController::class, 'delete'])->name('delete');
        Route::get('/edit', [ScheduleController::class, 'edit'])->name('edit');
        Route::post('/appointment', [ScheduleController::class, 'appointment'])->name('appointment');
        Route::get('/getdoctorlists', [ScheduleController::class, 'getdoctorlist'])->name('getdoctorlists');
        Route::get('/list', [ScheduleController::class, 'list'])->name('list');
    });

});
