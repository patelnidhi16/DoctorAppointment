<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DoctorDataTable;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // public function dashboard()
    // {
    //     $appointment = Schedule::whereDate('date',Carbon::today())->get();
       
    //     $count = count($appointment);
    //     return view('Admin.content',compact('count'));
    // }

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

     public function index(DoctorDataTable $doctorDataTable)
    {
        return $doctorDataTable->render('Admin.Doctor.index');
    }
}
