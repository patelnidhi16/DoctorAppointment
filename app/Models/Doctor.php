<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Doctor extends Model
{   
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'mobile',  'start_time', 'end_time', 'shift',
    ];
    public function setname($value)
    {
        $this->attributes['first_name'] = Str::ucfirst($value);
        $this->attributes['last_name'] = Str::ucfirst($value);
    }
}
