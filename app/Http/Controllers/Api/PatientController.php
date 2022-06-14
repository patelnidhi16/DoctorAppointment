<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Interfaces\DoctorInterface;
use App\Interfaces\PatientInterface;
use App\Models\Patient;
use App\Repositories\PatientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends BaseController
{
    public function __construct(PatientInterface $patient)
    {
        $this->patient = new PatientRepository($patient);
    }
    public function index()
    {
        $patients = Patient::get();
        return $this->sendresponse($patients, 'Patient Listing', 200);
    }
    public function delete(Request $request)
    {
        $patient =  $this->patient->delete($request->all());

        return $this->sendresponse($patient, 'Doctor deleted successfully', 200);
    }
    public function create(Request $request)
    {
     ;
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|alpha|min:2',
            'last_name' => 'required|alpha|min:2',
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i|unique:patients,email,' . $request->id,
            'mobile' => 'required|numeric|digits:10|unique:patients,mobile,' . $request->id,
        ]);
        if ($validator->fails()) {
            return $this->sendError('validation error', $validator->errors(), 404);
        }
        $patient =  $this->patient->create($request->all());
        if ($request->id) {
            return $this->sendresponse($patient, 'Patient updated successfully', 200);
        } else {
            return $this->sendresponse($patient, 'Patient inserted successfully', 200);
        }
    }
}
