<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Redirect admin ke dashboard utama
     * Route: /admin -> redirect ke /admin/dashboard
     */
    public function index()
    {
        return redirect()->route('admin.dashboard');
    }
}