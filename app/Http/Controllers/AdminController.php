<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin/products');
        }

        return redirect()->back()->withInput()->with('error', 'Invalid credentials');
    }
    public function logout(Request $request)
{
    Auth::guard('admin')->logout();

    // Optionally, invalidate the session data
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect to login or home page
    return redirect()->route('admin.login');
}
}
