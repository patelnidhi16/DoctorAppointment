<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\AppointmentInterface;
use App\Mail\ConfirmationMail;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;
use App\Repositories\AppointmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends BaseController
{
    public function __construct(AppointmentInterface $appointment)
    {
        $this->appointment = new AppointmentRepository($appointment);
    }
    public function appointment(Request $request)
    {
       

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'shift' => 'required|numeric',
            'doctor_id' => 'required|numeric',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|after:start_time|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return $this->sendError('validation error', $validator->errors(), 404);
        }
      $appointment=  $this->appointment->appointment($request->all());
      return $appointment;
    }
}
