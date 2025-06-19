<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Ini sudah benar
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Log untuk debugging - HAPUS TANDA '\'
        Log::info('AuthAdmin middleware called', [
            'user_authenticated' => Auth::check(),
            'user_email' => Auth::check() ? Auth::user()->email : 'Unauthenticated',
            'user_type' => Auth::check() ? Auth::user()->utype : null
        ]);

        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login untuk mengakses halaman ini.');
        }

        // Cek apakah user adalah admin
        if (Auth::user()->utype !== 'ADM') {
            Log::warning('Non-admin user tried to access admin area', [
                'user_email' => Auth::user()->email,
                'user_type' => Auth::user()->utype
            ]);
            
            return redirect('/')
                ->with('error', 'Anda tidak memiliki izin untuk mengakses dashboard admin.');
        }

        return $next($request);
    }
}