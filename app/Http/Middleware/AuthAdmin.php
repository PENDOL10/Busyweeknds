<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
{
    public function handle(Request $request, Closure $next)
    {
        \Log::info('AuthAdmin middleware called for user: ' . (Auth::check() ? Auth::user()->email : 'Unauthenticated'));

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        if (Auth::user()->utype === 'ADM') {
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have permission to access the admin dashboard.');
    }
}