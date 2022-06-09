<?php

namespace App\Interfaces;

interface PatientInterface
{
    public function create(array $data);
    public function delete(array $data);
  
}