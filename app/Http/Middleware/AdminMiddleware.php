<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Cek role user
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
