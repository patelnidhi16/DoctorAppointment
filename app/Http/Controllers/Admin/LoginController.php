<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "admin/dashboard";
 
    public function __construct()
    { 
        $this->middleware('guest:admin')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    public function showLoginForm()
    {
        return view('Admin.login');
    }
   
    
    public function logout(Request $request)
    {
        // dd(123);
        $this->guard()->logout();
        return redirect()->route('admin.login');
    }
        
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
?>