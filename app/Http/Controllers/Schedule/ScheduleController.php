<?php

namespace App\Http\Controllers\Schedule;

use App\DataTables\ScheduleDataTable;
use App\Http\Controllers\Controller;
use App\Mail\ConfirmationMail;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ScheduleController extends Controller
{
    public function index(ScheduleDataTable $ScheduleDataTable)
    {
        return $ScheduleDataTable->render('Admin.Schedule.index');
    }
    public function create(Request $request)
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
    public function update(Request $request)
    {
        $request->validate([
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
            $data['msg'] = "Doctor is busy with another patient at this time. please select another time slote for appointment!!";
            return $data;
        } else {

            Schedule::where('id',$request->id)->update([
                    
                    'doctor_id' => $request->doctor_id,
                    'date' => $request->date,
                    'shift' => $request->shift,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                
             ] );

            $data['status'] = true;
            $data['msg'] = "Your appoinment is booked for Dr" . $request->doctor;

            //  Mail::to('abc@gmail.com')->send(new ConfirmationMail($name, $doctor, $date, $starttime, $endtime));

            return $data;
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
     
        $data = Schedule::find($id);
        $data->delete();
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Schedule::find($id);

        return $data;
    }
   
    public function getdoctorlist(Request $request)
    {
        $doctors = Doctor::where('shift', $request->id)->get()->toArray();
        return $doctors;
    }
    public function list(Request $request)
    {
      
        $doctors = Doctor::get()->toArray();
        return $doctors;
    }
}