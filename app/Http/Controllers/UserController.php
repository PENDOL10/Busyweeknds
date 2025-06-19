<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('customer-user.index', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('customer-user.index')->with('success', 'Password updated successfully.');
    }

    public function updateTelephone(Request $request)
    {
        $request->validate([
            'telephone' => 'required|numeric|digits:12|unique:users,telephone,' . auth()->id(),
        ]);

        $user = auth()->user();
        $user->update([
            'telephone' => $request->telephone,
        ]);

        return redirect()->route('customer-user.index')->with('success', 'Telephone updated successfully.');
    }
}