<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DoctorRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'first_name' => 'bail|required|alpha|min:2',
            'last_name' => 'required|alpha|min:2',
            'email' => 'required|email||unique:doctors,mobile,' . $request->id,
            'email' => 'required|unique:doctors,email,' . $request->id.'|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'mobile' => 'required|digits:10|unique:doctors,mobile,' . $request->id,
            'shift' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ];
    }
}
