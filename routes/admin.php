<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Doctor\DoctorController;
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

Route::group(['middleware' => 'auth:admin'], function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/appointmentcount', [AppointmentController::class, 'appointmentcount'])->name('appointmentcount');

    Route::group(['prefix' => 'doctor', 'as' => "doctor."], function () {
        Route::get('/index', [AdminController::class, 'index'])->name('index');
        Route::post('/create', [AdminController::class, 'create'])->name('create');
        Route::get('/delete', [DoctorController::class, 'delete'])->name('delete');
        Route::get('/edit', [DoctorController::class, 'edit'])->name('edit');
        Route::post('/update', [DoctorController::class, 'update'])->name('update');
        
    });
    Route::group(['prefix' => 'appointment', 'as' => "appointment."], function () {
        Route::post('/create', [AppointmentController::class, 'create'])->name('create');
        Route::get('/getdoctor', [AppointmentController::class, 'getdoctor'])->name('getdoctor');
        Route::get('/index', [AppointmentController::class, 'index'])->name('index');
        Route::get('/delete', [AppointmentController::class, 'delete'])->name('delete');
        Route::get('/edit', [AppointmentController::class, 'edit'])->name('edit');
        Route::post('/update', [AppointmentController::class, 'update'])->name('update');
    });
});
