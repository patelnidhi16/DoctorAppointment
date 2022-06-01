<?php

namespace App\Http\Controllers\Appointment;

use App\DataTables\AppointmentDataTable;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(AppointmentDataTable $AppointmentDataTable)
    {
       $doctors=Doctor::get(['id','name']);
       return $AppointmentDataTable->render('Admin.Appointment.index',compact('doctors'));

    }
    public function create(Request $request)
    {
    //   dd($request->all());
        $request->validate([
            'name' => 'required|alpha|min:2',
            'email' => 'required|email|unique:appointments|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'mobile' => 'required|digits:10',
            'doctor' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        Appointment::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
            'name' => $request->name,
            'email' => $request->email,
           
            'mobile' => $request->mobile,
            'doctor_id' => $request->doctor,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
       
        $data = Appointment::find($id);
        $data->delete();
        
    }
}
