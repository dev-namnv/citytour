<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckGuide
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
        // Allow ADMIN, EDITOR access
        if (Auth::user()->role === ADMIN || Auth::user()->role === GUIDE) {
            return $next($request);
        }

        return abort(403, HTTP_ERROR_403);
    }
}
