<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Patient extends Model
{
    use HasFactory;
    public $guarded = [];
    public function setname($value)
    {
        $this->attributes['first_name'] = Str::ucfirst($value);
        $this->attributes['last_name'] = Str::ucfirst($value);
    }
}
