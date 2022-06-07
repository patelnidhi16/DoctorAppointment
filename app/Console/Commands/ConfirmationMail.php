<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ConfirmationMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'approve:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Your Appointment is Booked';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $message='Your Appointment is Booked';

    }
}
