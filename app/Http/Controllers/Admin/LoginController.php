<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = "/admin/dashboard";

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {

        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }
    protected function validateLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',

        ]);
    }
    function doLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',   // required and email format validation
            'password' => 'required', // required and number field validation

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json($validator->errors(), 422);
            // validation failed return with 422 status

        } else {

            //validations are passed try login using laravel auth attemp
            if (Auth::attempt($request->only(["email", "password"]))) {

                return response()->json(["status" => true, "redirect_location" => url("dashboard")]);
            } else {
                return response()->json([["Invalid credentials"]], 422);
            }
        }
    }
    public function showLoginForm(Request $request)
    {
        return view('Admin.login');
    }
    public function logout(Request $request)
    {
        $this->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
