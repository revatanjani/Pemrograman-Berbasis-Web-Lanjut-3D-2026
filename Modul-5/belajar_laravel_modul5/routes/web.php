<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;

Route::get('/', fn () => redirect()->route('buku.index'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', fn () => auth()->user()->hasRole('admin')
        ? redirect()->route('admin.dashboard')
        : (auth()->user()->hasRole('petugas') ? redirect()->route('petugas.dashboard') : redirect()->route('siswa.dashboard')))
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->middleware('permission:lihat profil sendiri')->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->middleware('permission:ubah profil sendiri')->name('profile.update');

    Route::get('/buku', [PerpustakaanController::class, 'index'])->middleware('permission:lihat daftar buku')->name('buku.index');
    Route::get('/buku/{id}', [PerpustakaanController::class, 'detail'])->middleware('permission:lihat daftar buku')->name('buku.detail');

    Route::get('/riwayat-peminjaman', [DashboardController::class, 'riwayat'])->middleware('permission:melihat riwayat peminjaman sendiri')->name('riwayat');

    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->middleware('role:admin')->name('admin.dashboard');
    Route::get('/petugas/dashboard', [DashboardController::class, 'petugas'])->middleware('role:petugas')->name('petugas.dashboard');
    Route::get('/siswa/dashboard', [DashboardController::class, 'siswa'])->middleware('role:siswa')->name('siswa.dashboard');
    Route::get('/laporan-perpustakaan', [DashboardController::class, 'laporan'])->middleware('permission:lihat laporan perpustakaan')->name('laporan.index');

    Route::middleware('permission:kelola data buku')->group(function () {
        Route::get('/admin/buku', [PerpustakaanController::class, 'index'])->name('admin.buku');
    });
    Route::middleware('permission:kelola data pengguna')->group(function () {
        Route::view('/admin/pengguna', 'admin.pengguna')->name('admin.pengguna');
    });
});
