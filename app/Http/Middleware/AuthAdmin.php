<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna sudah login
        if(!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Periksa jika pengguna adalah admin
        if(Auth::user()->utype === 'ADM') {
            return $next($request);
        }
        
        // Jika bukan admin, redirect ke dashboard user dengan pesan
        return redirect()->route('customer-user.index')
            ->with('error', 'Unauthorized access.');
    }
}