<?php

namespace App\Http\Controllers\Patient;

use App\DataTables\PatientDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
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
    public function create(PatientRequest $request)
    {
        Patient::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'user_name' => $request->first_name . '_' . $request->mobile,
                'name' => $request->first_name.' '.$request->last_name,
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

    public function getdoctorlist(Request $request)
    {
        $doctors = Doctor::where('shift', $request->id)->get()->toArray();
        return $doctors;
    }
}
