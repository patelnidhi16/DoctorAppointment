<?php

namespace App\Providers;

use App\Interfaces\AppointmentInterface;
use App\Interfaces\DoctorInterface;
use App\Interfaces\PatientInterface;
use App\Interfaces\StoreInterface;
use App\Repositories\AppointmentRepository;
use App\Repositories\DeleteRepository;
use App\Repositories\DoctorRepository;
use App\Repositories\PatientRepository;
use App\Repositories\StoreRepository;
use DeleteInterface;
use Illuminate\Support\ServiceProvider;


// use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AppointmentInterface::class, AppointmentRepository::class);
        $this->app->bind(DoctorInterface::class, DoctorRepository::class);
        $this->app->bind(PatientInterface::class, PatientRepository::class);
    }
    public function boot()
    {

    }
}