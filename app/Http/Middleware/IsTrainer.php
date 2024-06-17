<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class IsTrainer
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
        if (Auth::user() && Auth::user()->hasAnyPermission(['manage_trainer'])) {
            return $next($request);
        } else {
            $accessToken = Auth::user()->token();
            $accessToken->revoke();

            return response([
                'message' => 'You are not authorized to access this route!',
                'success' => 0
            ]);
        }
    }
}
