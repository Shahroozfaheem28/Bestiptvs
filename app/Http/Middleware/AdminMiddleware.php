<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
             return redirect()->route('login.form')->with('error', 'Please login as admin to access this page.');
        }

        return $next($request);
    }
}
