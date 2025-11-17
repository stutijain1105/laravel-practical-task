<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function showRegister()
    {
        return view('customer.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => 'customer',
        ]);

        $user->sendEmailVerificationNotification();

        return back()->with('success', 'Customer Registered! Please verify email.');
    }
}

