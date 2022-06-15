<?php

namespace App\Http\Controllers\Doctor;

use App\DataTables\DoctorDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Interfaces\DoctorInterface;
use App\Models\Doctor;
use App\Repositories\DoctorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    public function __construct(DoctorInterface $doctor)
    {
        $this->doctor = new DoctorRepository($doctor);
    }
    public function index(DoctorDataTable $doctorDataTable)
    {
        return $doctorDataTable->render('Admin.Doctor.index');
    }
    public function create(DoctorRequest $request)
    {
       $this->doctor->create($request->all());
       
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
