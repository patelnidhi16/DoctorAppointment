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
        $doctors = Doctor::get(['id', 'name']);
        return $AppointmentDataTable->render('Admin.Appointment.index', compact('doctors'));
    }
    public function create(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|alpha|min:2',
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i|unique:doctors,email,' . $request->id,
            'mobile' => 'required|digits:10|unique:doctors,mobile,' . $request->id,
            'doctor_id' => 'required',
            'date' => 'required',
            'end_time' => 'required|after:start_time',
        ]);
        $data['status'] = "success";
        $start_time = Appointment::where('doctor_id', $request->doctor)->get('start_time')->toArray();
        $end_time = Appointment::where('doctor_id', $request->doctor)->get('end_time')->toArray();

        foreach ($start_time as $stime) {

            foreach ($end_time as $etime) {
                if ($stime['start_time'] >= $request->start_time && $etime['end_time'] <= $request->end_time || $stime['start_time'] <= $request->start_time && $etime['end_time'] >= $request->end_time) {
                    $data['status'] = false;
                    $data['msg'] = $request->doctor . "is busy with another patient at this time. please select another time slote for appointment!!";
                }
            }
        }
        if ($data['status'] == false) {
            $data['status'] = false;
            $data['msg'] = $request->doctor . "is busy with another patient at this time. please select another time slote for appointment!!";
            return $data;
        } else {
            Appointment::updateOrCreate(
                [
                    'id' => $request->id,
                ],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'doctor_id' => $request->doctor_id,
                    'date' => $request->date,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                ]
            );
            $data['status'] = true;
            $data['msg'] = "Your appoinment is booked for Dr" . $request->doctor;
            return $data;
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        $data = Appointment::find($id);
        $data->delete();
    }
    public function edit(Request $request)
    {
        $id = $request->id;

        $data = Appointment::find($id);

        return $data;
    }
   
}
