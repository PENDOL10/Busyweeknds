<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthOwner
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        if (Auth::user()->utype === 'OWN') {
            return $next($request);
        }

        return redirect()->route('index')->with('error', 'You do not have permission to access the owner dashboard.');
    }
}