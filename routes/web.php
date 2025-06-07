<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\DocumentationController;

// Web Routes
Route::get('/', function () {
    return view('auth.login');
});

// User Management Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

// Middleware for Role-Based Access Control
Route::middleware(['auth'])->group(function () {
    // Authentication Routes
    Route::middleware(['auth', 'check.role:ProjectManager'])->group(function () {
        Route::resource('materials', MaterialController::class);
        Route::resource('clients', ClientController::class);
        Route::resource('users', UserController::class);
    });

    Route::middleware(['auth', 'check.role:ProjectManager,Engineer'])->group(function () {
        Route::resource('projects', ProjectController::class);
        Route::resource('materials', MaterialController::class);
    });

    // Route untuk menampilkan daftar proyek
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

    // Route untuk menghapus proyek
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/documentations', [DocumentationController::class, 'index'])->name('projects.documentations');
});