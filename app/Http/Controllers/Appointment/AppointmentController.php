<?php

namespace App\Http\Controllers\Appointment;

use App\DataTables\AppointmentDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\AppointmentInterface;
use App\Mail\ConfirmationMail;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Repositories\AppointmentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AppointmentController extends Controller
{
    public function __construct(AppointmentInterface $appointment)
    {
        $this->appointment = new AppointmentRepository($appointment);
    }
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
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);
        $appointment =  $this->appointment->appointment($request->all());
        return $appointment;
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

    public function getdoctor(Request $request)
    {
        $doctors = Doctor::where('shift', $request->id)->get()->toArray();
        return $doctors;
    }
}
