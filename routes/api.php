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
    });
    Route::group(['prefix' => 'appointment', 'as' => "appointment."], function () {
        Route::post('/appointmentapi', [AppointmentController::class, 'appointment'])->name('appointment');
    });
    Route::group(['prefix' => 'patient', 'as' => "patient."], function () {
        Route::post('/patientapi', [PatientController::class, 'patient'])->name('patient');
    });
});
