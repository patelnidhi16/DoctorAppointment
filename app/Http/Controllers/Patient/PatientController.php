<?php

namespace App\Http\Controllers\Patient;

use App\DataTables\PatientDataTable;
use App\Http\Controllers\Controller;
use App\Mail\ConfirmationMail;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PatientController extends Controller
{

    public function index(PatientDataTable $PatientDataTable)
    {
        return $PatientDataTable->render('Admin.Patient.index');
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha|min:2',
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i|unique:patients,email,' . $request->id,
            'mobile' => 'required|numeric|digits:10|unique:patients,mobile,' . $request->id,
        ]);


        Patient::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'user_name' => $request->name . '_' . $request->mobile,
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,

            ]
        );
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        $data = Patient::find($id);
        $data->delete();
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Patient::find($id);

        return $data;
    }
    public function appointment(Request $request)
    {
        $patient=   Patient::where('id',$request->user_id)->get(['name','user_name'])->toArray();
      
        $request->validate([
            'user_id' => 'required',
            'shift' => 'required',
            'doctor_id' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);
        $data['status'] = "success";
        $start_time = Schedule::where('doctor_id', $request->doctor_id)->where('date', $request->date)->get('start_time')->toArray();
        $end_time = Schedule::where('doctor_id', $request->doctor_id)->where('date', $request->date)->get('end_time')->toArray();
        $doctor = Doctor::where('id', $request->doctor_id)->get()->toArray();

        foreach ($start_time as $stime) {

            foreach ($end_time as $etime) {
                if ($doctor[0]['start_time'] > $request->start_time || $doctor[0]['end_time'] < $request->end_time || $stime['start_time'] >= $request->start_time && $etime['end_time'] <= $request->end_time || $stime['start_time'] <= $request->start_time && $etime['end_time'] >= $request->end_time) {
                    $data['status'] = false;
                    $data['msg'] = "Doctor is busy with another patient at this time. please select another time slote for appointment!!";
                }
            }
        }
        // $name = $request->name;
        $doctor_id = $request->doctor_id;
        $date = $request->date;
        $starttime = $request->start_time;
        $endtime = $request->end_time;
        $doctor = Doctor::where('id', $doctor_id)->get('name')->toArray();

        $doctor = $doctor[0]['name'];
        if ($data['status'] == false) {

            $data['status'] = false;
            $data['msg'] = $doctor . " " . "is busy with another patient at this time. please select another time slote for appointment!!";
            return $data;
        } else {

            Schedule::updateOrCreate(
                [
                    'id' => $request->id,
                ],
                [
                    'user_id' => $request->user_id,
                    'shift' => $request->shift,
                    'doctor_id' => $request->doctor_id,
                    'date' => $request->date,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                ]
            );

            $data['status'] = true;
            $data['msg'] = "Your appoinment is booked for Dr" . ' ' . $doctor;

            Mail::to('abc@gmail.com')->send(new ConfirmationMail($patient[0]['name'],$patient[0]['user_name'], $doctor, $date, $starttime, $endtime));

            return $data;
        }
    }

    public function getdoctorlist(Request $request)
    {
        $doctors = Doctor::where('shift', $request->id)->get()->toArray();
        return $doctors;
    }
}
