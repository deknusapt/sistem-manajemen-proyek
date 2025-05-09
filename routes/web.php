<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MaterialController;

// Web Routes
Route::get('/', function () {
    return view('auth.login');
});

// Authentication Routes
Route::resource('users', UserController::class);
Route::resource('clients', ClientController::class);
Route::resource('projects', ProjectController::class);


// User Management Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

// Middleware for Role-Based Access Control
Route::middleware(['auth'])->group(function () {
    Route::get('/materials', [MaterialController::class, 'index']);

    // Rute untuk dashboard Project Manager
    Route::get('/dashboard/manager', function () {
        $menu = [
            ['label' => 'Projects', 'url' => '/projects', 'active' => 'projects*'],
            ['label' => 'Materials', 'url' => '/materials', 'active' => 'materials*'],
            ['label' => 'Clients', 'url' => '/clients', 'active' => 'clients*'],
            ['label' => 'Users', 'url' => '/users', 'active' => 'users*'],
            ['label' => 'Reports', 'url' => '/reports', 'active' => 'reports*'],
        ];
        return view('dashboard.manager', compact('menu'));
    })->name('dashboard.manager');

    // Rute untuk dashboard Engineer
    Route::get('/dashboard/engineer', function () {
        $menu = [
            ['label' => 'Projects', 'url' => '/projects', 'active' => 'projects*'],
            ['label' => 'Materials', 'url' => '/materials', 'active' => 'materials*'],
        ];
        return view('dashboard.engineer', compact('menu'));
    })->name('dashboard.engineer');

    // Rute default untuk dashboard
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->role === 'ProjectManager') {
            return redirect()->route('dashboard.manager');
        } elseif ($user->role === 'Engineer') {
            return redirect()->route('dashboard.engineer');
        }
        abort(403, 'Unauthorized access');
    })->name('dashboard');
});




