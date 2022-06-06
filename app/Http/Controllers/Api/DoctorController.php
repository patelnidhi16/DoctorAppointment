<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends BaseController
{
    public function index(Request $request)
    {
        if ($request->name && $request->shift) {

            $doctors = Doctor::where('shift', $request->shift)->where('name', $request->name)->get();
        } elseif ($request->shift) {

            $doctors = Doctor::where('shift', $request->shift)->get();
        } elseif ($request->name) {

            $doctors = Doctor::where('name', $request->name)->get();
        } else {

            $doctors = Doctor::get();
        }
        return $this->sendresponse($doctors, 'Doctor Listing', 200);
    }
}
