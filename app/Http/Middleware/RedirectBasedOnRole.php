<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->utype === 'ADM') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->utype === 'USR') {
                return redirect()->route('customer-user.index');
            } elseif (Auth::user()->utype === 'OWN') {
                return redirect()->route('owner.index');
            }
        }
        return $next($request);
    }
}