<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function create(Request $request)
    {
            $request->validate([
                'name'=>'required|alpha|min:2',
                'email'=>'required|email|unique:doctors|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'mobile'=>'required|digits:10',
                'shift'=>'required',
                'start_time'=>'required',
                'end_time'=>'required|after:start_time',
        ]);

        Doctor::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'mobile'=>$request->mobile,
            'shift'=>$request->shift,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ]);
    }
}
