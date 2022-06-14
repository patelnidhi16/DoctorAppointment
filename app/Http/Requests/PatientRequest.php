<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PatientRequest extends FormRequest
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
                'last_name' => 'bail|required|alpha|min:2',
                'email' => 'bail|required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i|unique:patients,email,' . $request->id,
                'mobile' => 'bail|required|numeric|digits:10|unique:patients,mobile,' . $request->id,
            
        ];
    }
}
