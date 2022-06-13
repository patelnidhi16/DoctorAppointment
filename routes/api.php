<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/registerapi', [LoginController::class, 'register'])->name('registerapi');
Route::post('/loginapi', [LoginController::class, 'login'])->name('loginapi');
Route::post('/logoutapi', [LoginController::class, 'logout'])->name('logoutapi');

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'doctor', 'as' => "doctor."], function () {
        Route::post('/index', [DoctorController::class, 'index'])->name('index');
        Route::post('/create', [DoctorController::class, 'create'])->name('create');
        Route::get('/delete', [DoctorController::class, 'delete'])->name('delete');
    });
    Route::group(['prefix' => 'appointment', 'as' => "appointment."], function () {
        Route::post('/create', [AppointmentController::class, 'create'])->name('appointment');
        Route::get('/delete', [AppointmentController::class, 'delete'])->name('delete');
        Route::get('/index', [AppointmentController::class, 'index'])->name('index');
    });
    Route::group(['prefix' => 'patient', 'as' => "patient."], function () {
        Route::get('/index', [PatientController::class, 'index'])->name('index');
        Route::get('/delete', [PatientController::class, 'delete'])->name('delete');
        Route::post('/create', [PatientController::class, 'create'])->name('create');
    });
});
