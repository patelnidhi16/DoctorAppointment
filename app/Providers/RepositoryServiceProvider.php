<?php

namespace App\Providers;

use App\Interfaces\AppointmentInterface;
use App\Interfaces\StoreInterface;
use App\Repositories\AppointmentRepository;
use App\Repositories\DeleteRepository;
use App\Repositories\StoreRepository;
use DeleteInterface;
use Illuminate\Support\ServiceProvider;

// use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AppointmentInterface::class, AppointmentRepository::class);
    }
    public function boot()
    {

    }
}