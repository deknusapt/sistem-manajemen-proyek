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
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

// Web Routes
Route::get('/', function () {
    return view('auth.login');
});

// User Management Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->middleware('guest')->name('password.email');

// Reset Password Routes
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->middleware('guest')->name('password.update');

// Middleware for Role-Based Access Control
Route::middleware(['auth'])->group(function () {
    // Authentication Routes
    Route::middleware(['auth', 'check.role:ProjectManager'])->group(function () {
        Route::resource('materials', MaterialController::class);
        Route::resource('clients', ClientController::class);
        Route::resource('users', UserController::class);
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });

    Route::middleware(['auth', 'check.role:ProjectManager,Engineer'])->group(function () {
        Route::resource('projects', ProjectController::class);
        Route::resource('materials', MaterialController::class);
        
        // Route untuk Documentations
        Route::get('/projects/{project}/documentations', [DocumentationController::class, 'index'])->name('projects.documentations');
        Route::get('/projects/{project}/documentations/create', [DocumentationController::class, 'create'])->name('documentations.create');
        Route::post('/documentations', [DocumentationController::class, 'store'])->name('documentations.store');
        Route::get('/documentations/{documentation}/edit', [DocumentationController::class, 'edit'])->name('documentations.edit');
        Route::put('/documentations/{documentation}', [DocumentationController::class, 'update'])->name('documentations.update');
        Route::delete('/documentations/{documentation}', [DocumentationController::class, 'destroy'])->name('documentations.destroy');
        Route::get('/documentations/{documentation}', [DocumentationController::class, 'show'])->name('documentations.show');
    });

    // Route untuk menampilkan daftar proyek
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

    // Route untuk menghapus proyek
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::put('/projects/{project}/update-status', [ProjectController::class, 'updateStatus'])->name('projects.updateStatus');
});