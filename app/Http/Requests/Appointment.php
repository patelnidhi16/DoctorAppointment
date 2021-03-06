<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Appointment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shift' => 'required',
            'doctor_id' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ];
    }
}
