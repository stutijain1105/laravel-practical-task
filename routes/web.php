<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CustomerAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('welcome');
});

// Laravel internal login fallback
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Email verification notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Email verify handler
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/admin/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resend email verification
Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Auth routes
Route::get('customer/register', [CustomerAuthController::class, 'showRegister']);
Route::post('customer/register', [CustomerAuthController::class, 'register'])->name('customer.register');

Route::get('admin/register', [AdminAuthController::class, 'showRegister']);
Route::post('admin/register', [AdminAuthController::class, 'register'])->name('admin.register');

Route::get('admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login');

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
