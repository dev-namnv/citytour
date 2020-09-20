<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Allow ADMIN, PARTNER, EMPLOYEE to access
        if (Auth::check() && (Auth::user()->role === ADMIN || Auth::user()->role === PARTNER || Auth::user()->role === EMPLOYEE)) {
            return $next($request);
        }
        return abort(403, HTTP_403);
    }
}
