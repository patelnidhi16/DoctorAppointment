<?php

namespace App\Interfaces;

interface AppointmentInterface
{
    public function create(array $data);
    public function delete(array $data);
   
}