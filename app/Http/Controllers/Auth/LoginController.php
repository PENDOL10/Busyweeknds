<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/'; // Default redirect, overridden in authenticated method

    protected function authenticated(Request $request, $user)
    {
        // Arahkan semua pengguna ke index setelah login
        return redirect()->route('index');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        $login = request()->input('login');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'telephone';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }
}