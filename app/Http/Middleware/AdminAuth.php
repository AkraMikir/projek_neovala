<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated as an admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Redirect to login page if not authenticated or not an admin
            return redirect('/admin/login');
        }

        return $next($request);
    }
}