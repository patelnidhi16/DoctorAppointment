<?php

namespace App\Http\Controllers\Appointment;

use App\DataTables\AppointmentDataTable;
use App\Http\Controllers\Controller;
use App\Mail\ConfirmationMail;
use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AppointmentController extends Controller
{
    public function index(AppointmentDataTable $AppointmentDataTable)
    {

        $doctors = Doctor::get(['id', 'name']);
        $appointment = Appointment::groupby('date')->get(['date']);
        return $AppointmentDataTable->render('Admin.Appointment.index', compact('doctors', 'appointment'));
    }
    public function create(Request $request)
    {


        $request->validate([
            'name' => 'required|alpha|min:2',
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i|unique:doctors,email,' . $request->id,
            'mobile' => 'required|digits:10|unique:doctors,mobile,' . $request->id,
            'shift' => 'required',
            'doctor_id' => 'required',
            'date' => 'required',
            'end_time' => 'required|after:start_time',
        ]);
        $data['status'] = "success";
        $start_time = Appointment::where('doctor_id', $request->doctor_id)->where('date', $request->date)->get('start_time')->toArray();
        $end_time = Appointment::where('doctor_id', $request->doctor_id)->where('date', $request->date)->get('end_time')->toArray();

        foreach ($start_time as $stime) {

            foreach ($end_time as $etime) {

                if ($stime['start_time'] >= $request->start_time && $etime['end_time'] <= $request->end_time || $stime['start_time'] <= $request->start_time && $etime['end_time'] >= $request->end_time) {
                    $data['status'] = false;
                    $data['msg'] = "Doctor is busy with another patient at this time. please select another time slote for appointment!!";
                }
            }
        }
        $name = $request->name;
        $doctor_id = $request->doctor_id;
        $date = $request->date;
        $starttime = $request->start_time;
        $endtime = $request->end_time;
        $doctor = Doctor::where('id', $doctor_id)->get('name')->toArray();

        $doctor = $doctor[0]['name'];
        if ($data['status'] == false) {

            $data['status'] = false;
            $data['msg'] = "Doctor is busy with another patient at this time. please select another time slote for appointment!!";
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
                    'shift' => $request->shift,
                    'doctor_id' => $request->doctor_id,
                    'date' => $request->date,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                ]
            );

            $data['status'] = true;
            $data['msg'] = "Your appoinment is booked for Dr" . $request->doctor;

            Mail::to('abc@gmail.com')->send(new ConfirmationMail($name, $doctor, $date, $starttime, $endtime));

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

    public function appointmentcount()
    {
        $appointment = Appointment::whereDate('created_at', Carbon::today())->get();
        $count = count($appointment);
    }

    public function getdoctor(Request $request){
        dd($request->all());
    }
}
