<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
   
    public function handle(Request $request, Closure $next, ...$guards)
    {
        //  dd($guards);
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if($guard=='admin')
            { 
                if (Auth::guard($guard)->check()) {
                    return redirect(RouteServiceProvider::ADMIN);
                }
            }
            else 
            {
                if (Auth::guard($guard)->check()) {
                    return redirect(RouteServiceProvider::HOME);
                }
            }
        }
        return $next($request);
    }
}