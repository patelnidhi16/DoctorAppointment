<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ExampleDataTable;
use App\Exports\StudentExport;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Example;
use App\Models\Patient;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $appointment = Schedule::whereDate('date', Carbon::today())->get();
        $todayappointmentcount = count($appointment);
        $totalappointment = Schedule::get();
        $totalappointmentcount = count($totalappointment);
        $patients = Patient::get();
        $patientcount = count($patients);
        $doctors = Doctor::get();
        $doctorscount = count($doctors);
        $doctor_info = Schedule::with('getdoctor')->groupBy('doctor_id')->select('doctor_id', DB::raw('count(*) as total'))->get()->toArray();
        $today_doctor_info = Schedule::with('getdoctor')->whereDate('date', Carbon::today())->groupBy('doctor_id')->select('doctor_id', DB::raw('count(*) as total'))->get()->toArray();

        return view('Admin.content', compact('todayappointmentcount', 'patientcount', 'doctorscount', 'doctor_info', 'today_doctor_info', 'totalappointmentcount'));
    }
    public function profile()
    {
        return view('Admin.profile');
    }
    public function notfound()
    {
        return view('Admin.notfound');
    }
    public function createprofile(Request $request)
    {
        // dd($request->all());
        $image = $request->file('image')->getClientOriginalName();

        Admin::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $image,
        ]);

        
        $request->image->move('public/', $image);
        return  redirect()->route('admin.dashboard');
    }
}
