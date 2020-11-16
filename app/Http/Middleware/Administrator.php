<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Administrator
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
        if (!Auth::check()) {
            return redirect()->route('authentication');
        }
        // Only allow ADMIN access
        if (Auth::user()->role === ADMIN) {
            return $next($request);
        }
        return abort(403, HTTP_ERROR_403);
    }
}
