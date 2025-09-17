<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Http\Controllers\Controller;

    class AdminController extends Controller
    {
    public function showLoginForm()
    {
    return view('admin.login'); // this is your login.blade.php view
    }

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        return redirect('/admin/dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}

    public function adminDashboard()
    {
        return view('admin.admin');
    }

    public function logout(Request $request)
{
    Auth::guard('admin')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login')->with('message', 'You have been logged out.');
}
}