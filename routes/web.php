<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

// Public Space
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/search', [PublicController::class, 'search'])->name('search');
Route::get('/requests', [RequestController::class, 'index'])->name('requests.index');
Route::post('/requests/{id}/donate', [RequestController::class, 'donate'])->name('requests.donate');

// Guest Space
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated Space
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Donor Dashboard
    Route::get('/dashboard', [DonorController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/availability', [DonorController::class, 'toggleAvailability'])->name('dashboard.availability');
    Route::post('/dashboard/logs', [DonorController::class, 'addLog'])->name('dashboard.logs');
    Route::delete('/dashboard/logs/{id}', [DonorController::class, 'deleteLog'])->name('dashboard.logs.delete');
    Route::post('/dashboard/profile', [DonorController::class, 'updateProfile'])->name('dashboard.profile');

    // Create requests
    Route::get('/requests/create', [RequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');
});

// Admin Command Center
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/requests/{id}/toggle-approve', [AdminController::class, 'toggleApprove'])->name('admin.requests.toggle-approve');
    Route::delete('/admin/requests/{id}', [AdminController::class, 'deleteRequest'])->name('admin.requests.delete');
    Route::post('/admin/users/{id}/toggle-role', [AdminController::class, 'toggleRole'])->name('admin.users.toggle-role');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});
