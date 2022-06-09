<?php

namespace App\Repositories;

use App\Interfaces\AppointmentInterface;
use App\Mail\ConfirmationMail;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;
use Illuminate\Support\Facades\Mail;

class AppointmentRepository implements AppointmentInterface
{
    public function create(array $data)
    {
        $patient = Patient::where('id',$data['user_id'])->get()->toArray();
      
        $data['status'] = "success";
        if ($data['id']) {
            $start_time = Schedule::where('doctor_id', $data['doctor_id'])->where('id', '!=', $data['id'])->where('date', $data['date'])->get('start_time')->toArray();
            $end_time = Schedule::where('doctor_id', $data['doctor_id'])->where('id', '!=', $data['id'])->where('date', $data['date'])->get('end_time')->toArray();
        } else {
            $start_time = Schedule::where('doctor_id', $data['doctor_id'])->where('date', $data['date'])->get('start_time')->toArray();
            $end_time = Schedule::where('doctor_id', $data['doctor_id'])->where('date', $data['date'])->get('end_time')->toArray();
        }
        $doctor = Doctor::where('id', $data['doctor_id'])->get()->toArray();
        if ($data['start_time'] < $doctor[0]['start_time'] ||  $data['end_time'] > $doctor[0]['end_time']) {
            $data['status'] = false;
            $data['msg'] = "Doctor" . $doctor[0]['name'] . " is Not available at your selected time. please select another time slote for appointment!!";
        }
        foreach ($start_time as $stime) {

            foreach ($end_time as $etime) {

                if (($stime['start_time'] >= $data['start_time'] && $etime['end_time'] <=  $data['end_time']) || ($stime['start_time'] <= $data['start_time'] && $etime['end_time'] >= $data['end_time'])) {

                    $data['status'] = false;
                    $data['msg'] = "Doctor" . $doctor[0]['name'] . " is busy with another patient at your selected time. please select another time slote for appointment!!";
                }
            }
        }
        $name = $patient[0]['name'];
        $email = $patient[0]['email'];
        $user_name = $patient[0]['user_name'];
        $doctor_id = $data['doctor_id'];
        $date = $data['date'];
        $starttime = $data['start_time'];
        $endtime = $data['end_time'];

        $doctor = Doctor::where('id', $doctor_id)->get()->toArray();

        $doctor = $doctor[0]['name'];
        if ($data['status'] == false) {

            $data['status'] = false;

            return $data;
        } else {

            Schedule::updateOrCreate(
                [
                    'id' => $data['id'],
                ],
                [
                    'user_id' => $data['user_id'],
                    'shift' => $data['shift'],
                    'doctor_id' => $data['doctor_id'],

                    'date' => $data['date'],
                    'start_time' => $data['start_time'],
                    'end_time' => $data['end_time'],
                ]
            );
            $data['status'] = true;
            if($data['id']){

                $data['msg'] = "Your appoinment is updated for Dr" . " " . $doctor;
            }else{

                $data['msg'] = "Your appoinment is booked for Dr" . " " . $doctor;
            }

            Mail::to($email)->send(new ConfirmationMail($patient[0]['name'], $patient[0]['user_name'], $doctor, $date, $starttime, $endtime));
            return $data;
        }
    }
    public function delete(array $data){
    
        $id = $data['id'];
        $data = Schedule::find($id);
        $data->delete();
        return $data;
    }
}
