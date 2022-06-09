<?php

namespace App\Repositories;


use App\Interfaces\DoctorInterface;
use App\Models\Doctor;

class DoctorRepository implements DoctorInterface
{

    public function create(array $data)
    {
        $doctor = Doctor::updateOrCreate(
            [
                'id' => $data['id'],
            ],
            [
                'name' => ucfirst($data['first_name']) . " " . ucfirst($data['last_name']),
                'email' => $data['email'],
                'mobile' => $data['mobile'],
                'shift' => $data['shift'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],

            ]
        );
        return $doctor;
    }
    public function delete(array $data)
    {
        $id = $data['id'];
        $data = Doctor::find($id);
        $data->delete();
        return $data;
    }
}
