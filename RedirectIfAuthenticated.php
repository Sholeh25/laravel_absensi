<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Jika user sudah login di guard ini
        if (Auth::guard($guard)->check()) {

            $user = Auth::guard($guard)->user();

            // Safety, jika user null
            if (!$user) {
                return redirect('/login');
            }

            // Admin
            if ($user->role === 'admin') {
                return redirect('/admin');
            }

            // Employee
            if ($user->role === 'employee') {
                return redirect('/employee');
            }

            // Fallback jika role tidak dikenali
            return redirect('/home');
        }

        return $next($request);
    }
}
