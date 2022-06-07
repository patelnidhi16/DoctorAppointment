<?php

namespace App\Http\Controllers\Doctor;

use App\DataTables\DoctorDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    public function index(DoctorDataTable $doctorDataTable)
    {
        return $doctorDataTable->render('Admin.Doctor.index');
    }
    public function create(DoctorRequest $request)
    {
        Doctor::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'name' => ucfirst($request->first_name) . " " . ucfirst($request->last_name),
                'email' => $request->email,
                'password' => $request->password,
                'mobile' => $request->mobile,
                'shift' => $request->shift,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,

            ]
        );
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $data = Doctor::find($id);
        $data->delete();
        return $data;
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Doctor::find($id);
        return $data;
    }

   
}
