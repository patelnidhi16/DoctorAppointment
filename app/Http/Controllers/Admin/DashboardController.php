<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $appointment = Schedule::whereDate('date', Carbon::today())->get();
        $todayappointmentcount = count($appointment);
        $patients = Patient::get();
        $patientcount = count($patients);
        $doctors = Patient::get();
        $doctorscount = count($doctors);
      
        $doctor_info = DB::table('schedules')
                ->select('doctor_id', DB::raw('count(*) as total'))
                 ->groupBy('doctor_id')
                 ->get()->toArray();
                 
        return view('Admin.content', compact('todayappointmentcount', 'patientcount', 'doctorscount','doctor_info'));
    }
}
