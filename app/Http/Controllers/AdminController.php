<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan ini ada
use App\Models\User;
use Illuminate\Support\Facades\Hash; 

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.admin');
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')
            ->with('success', 'Berhasil logout.');
    }
}