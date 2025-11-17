<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showRegister()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|min:6'
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => 'admin',
        ]);

        $user->sendEmailVerificationNotification();

        return back()->with('success', 'Admin Registered! Verify email.');
    }

    public function showLogin()
    {
        // If already logged in → redirect to dashboard
        if (auth()->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user)
            return back()->with('error', 'Invalid Credentials');

        if ($user->role !== "admin")
            return back()->with('error', 'You are not allowed to login from here');

        if (!auth()->attempt($request->only('email', 'password')))
            return back()->with('error', 'Invalid credentials');

        if (!$user->hasVerifiedEmail())
            return back()->with('error', 'Please verify your email first');

        return redirect('/admin/dashboard');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('message', 'Logged out successfully!');
    }

}

