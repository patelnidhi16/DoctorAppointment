<?php

// namespace App\Http\Controllers\Appointment;

// use App\DataTables\AppointmentDataTable;
// use App\Http\Controllers\Controller;
// use App\Http\Requests\Appointment as RequestsAppointment;
// use App\Interfaces\AppointmentInterface;
// use App\Mail\ConfirmationMail;
// use App\Models\Appointment;
// use App\Models\Doctor;
// use App\Repositories\AppointmentRepository;
// use Carbon\Carbon;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Redirect;

// class AppointmentController extends Controller
// {
//     public function __construct(AppointmentInterface $appointment)
//     {
//         $this->appointment = new AppointmentRepository($appointment);
//     }
//     public function index(AppointmentDataTable $AppointmentDataTable)
//     {

//         $doctors = Doctor::get(['id', 'name']);
//         $appointment = Appointment::groupby('date')->get(['date']);
//         return $AppointmentDataTable->render('Admin.Appointment.index', compact('doctors', 'appointment'));
//     }
//     public function create(RequestsAppointment $request)
//     {
      
//         $appointment =  $this->appointment->appointment($request->all());
//         return $appointment;
//     }

//     public function delete(Request $request)
//     {
//         $id = $request->id;

//         $data = Appointment::find($id);
//         $data->delete();
//     }
//     public function edit(Request $request)
//     {
//         $id = $request->id;

//         $data = Appointment::find($id);

//         return $data;
//     }
   
//     public function getdoctor(Request $request)
//     {
//         $doctors = Doctor::where('shift', $request->id)->get()->toArray();
//         return $doctors;
//     }
// }
