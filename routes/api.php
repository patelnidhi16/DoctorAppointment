<?php

use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\LoginController;
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


Route::group(['prefix' => 'doctor', 'as' => "doctor."], function () {
    Route::get('/index', [DoctorController::class, 'index'])->name('index');
});
