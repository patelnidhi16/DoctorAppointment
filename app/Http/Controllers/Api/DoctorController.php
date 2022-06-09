<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Interfaces\DoctorInterface;
use App\Models\Doctor;
use App\Repositories\DoctorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorController extends BaseController
{
    public function __construct(DoctorInterface $doctor)
    {
        $this->doctor = new DoctorRepository($doctor);
    }
    public function index(Request $request)
    {
        if ($request->name && $request->shift) {

            $doctors = Doctor::where('shift', $request->shift)->where('name', $request->name)->get();
        } elseif ($request->shift) {

            $doctors = Doctor::where('shift', $request->shift)->get();
        } elseif ($request->name) {

            $doctors = Doctor::where('name', $request->name)->get();
        } else {

            $doctors = Doctor::get();
        }
        return $this->sendresponse($doctors, 'Doctor Listing', 200);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|alpha|min:2',
            'last_name' => 'required|alpha|min:2',
            'email' => 'required|unique:doctors,email,' . $request->id . '|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'mobile' => 'required|digits:10|unique:doctors,mobile,' . $request->id,
            'shift' => 'required|numeric',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|after:start_time|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return $this->sendError('validation error', $validator->errors(), 404);
        }
        $doctor =  $this->doctor->create($request->all());
      
        if ($request->id) {

            return $this->sendresponse($doctor, 'Doctor updated successfully', 200);
        } else {
            return $this->sendresponse($doctor, 'Doctor inserted successfully', 200);
        }
    }

    public function delete(Request $request)
    {
        $doctor =  $this->doctor->delete($request->all());
      
            return $this->sendresponse($doctor, 'Doctor deleted successfully', 200);
        
    }
}
