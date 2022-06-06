<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends BaseController
{
    public function patient()
    {
        $patients = Patient::get();
        return $this->sendresponse($patients, 'Patient Listing', 200);
    }
}
