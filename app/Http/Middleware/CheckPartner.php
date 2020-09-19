<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPartner
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
        // Allow ADMIN, PARTNER to access
        if (Auth::check() && (Auth::user()->role === ADMIN || Auth::user()->role === PARTNER)) {
            return $next($request);
        }
        return abort(403, HTTP_403);
    }
}
