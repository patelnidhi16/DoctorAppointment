<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public $guarded =[];
    public function getdoctor(){
        return $this->hasMany(Doctor::class,'id','doctor_id');
    }
}
