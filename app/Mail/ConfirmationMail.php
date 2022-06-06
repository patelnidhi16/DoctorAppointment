<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$user_name, $doctor, $date, $starttime, $endtime)
    {
        $this->name=$name;
        $this->user_name=$user_name;
        $this->doctor=$doctor;
        $this->date=$date;
        $this->starttime=$starttime;
        $this->endtime=$endtime;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
   
        return $this->view('Admin.Appointment.confirmmail')->with('name',$this->name)->with('user_name',$this->user_name)->with('doctor',$this->doctor)->with('date',$this->date)->with('starttime',$this->starttime)->with('endtime',$this->endtime);
    }
}
