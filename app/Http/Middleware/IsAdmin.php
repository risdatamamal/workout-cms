<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user() && Auth::user()->hasAnyPermission([ 'manage_permission', 'manage_role', 'manage_user'])){
            return $next($request);
        } else {
            Auth::guard('web')->logout();
            Session::flush();
            return redirect('/');
        }
    }
}
