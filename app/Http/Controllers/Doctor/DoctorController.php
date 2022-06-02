<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha|min:2',
            'email' => 'required|email|unique:doctors|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'mobile' => 'required|digits:10|unique:doctors',
            'shift' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'mobile' => $request->mobile,
            'shift' => $request->shift,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
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

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha|min:2',
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i|unique:doctors,email,'.$request->id,
            'mobile' => 'required|number|difits:10|unique:doctors,mobile,'.$request->id,
            'shift' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);
        $id = $request->id;
        Doctor::where("id", $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'shift' => $request->shift,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
    }
}
