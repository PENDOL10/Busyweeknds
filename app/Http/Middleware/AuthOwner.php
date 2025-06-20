<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthOwner
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Cek apakah user memiliki role owner
        if (Auth::user()->utype !== 'OWN') {
            return redirect()->route('index')->with('error', 'You do not have permission to access the owner dashboard.');
        }

        return $next($request);
    }
}