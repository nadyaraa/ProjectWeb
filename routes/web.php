<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\KosController;
use App\Http\Controllers\PencariController; 
use App\Http\Controllers\AdminController; 

// Halaman Utama
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// ── Rute Pencari ──
Route::prefix('pencari')->name('pencari.')->group(function () {
    Route::get('/',        [PencariController::class, 'index'])->name('index');
    Route::get('/{kos}',   [PencariController::class, 'show'])->name('show');
});


// ── Kelompok Rute yang Wajib Login ──
Route::middleware('auth')->group(function () {
    
    // Rute Utama Dashboard & CRUD Kos
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('kos', KosController::class)->parameters([ 'kos' => 'kos' ]);

    // Rute Manajemen Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── Rute Khusus Admin ──
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.destroyUser');
    Route::get('/admin/kos', [AdminController::class, 'kos'])->name('admin.kos');
    Route::delete('/admin/kos/{kos}', [AdminController::class, 'destroyKos'])->name('admin.kos.destroy');
});

// Rute bawaan Breeze
require __DIR__.'/auth.php';