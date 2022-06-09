<?php

namespace App\Repositories;

use App\Interfaces\PatientInterface;
use App\Models\Patient;

class PatientRepository implements PatientInterface
{


    public function delete(array $data)
    {
        $id = $data['id'];
        $data = Patient::find($id);
        $data->delete();
        return $data;
    }
    public function create(array $data)
    {
        $patient =  Patient::updateOrCreate(
            [
                'id' => $data['id'],
            ],
            [
                'user_name' => $data['first_name'] . '_' . $data['mobile'],
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'email' => $data['email'],
                'mobile' => $data['mobile'],

            ]
        );
        return $patient;
    }
}
