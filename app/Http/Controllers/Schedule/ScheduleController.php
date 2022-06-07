<?php

namespace App\Http\Controllers\Schedule;

use App\DataTables\ScheduleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Interfaces\AppointmentInterface;
use App\Mail\ConfirmationMail;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;
use App\Repositories\AppointmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ScheduleController extends Controller
{
    public function __construct(AppointmentInterface $appointment)
    {
        $this->appointment = new AppointmentRepository($appointment);
    }
    public function index(ScheduleDataTable $ScheduleDataTable)
    {
        return $ScheduleDataTable->render('Admin.Schedule.index');
    }
    
    public function create(ScheduleRequest $request)
    {
        // $request->validate([
        //     'shift' => 'required',
        //     'doctor_id' => 'required',
        //     'date' => 'required',
        //     'start_time' => 'required',
        //     'end_time' => 'required|after:start_time',
        // ]);
        $appointment =  $this->appointment->appointment($request->all());
        return $appointment;
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
