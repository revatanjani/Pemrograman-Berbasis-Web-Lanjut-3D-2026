<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;

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
    
    Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->middleware('permission:lihat profil sendiri')->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->middleware('permission:ubah profil sendiri')->name('profile.update');

    // Route pengelolaan buku menggunakan Gate 'can:kelola-buku'
    Route::middleware('can:kelola-buku')->group(function () {
        Route::get('/buku/create', [PerpustakaanController::class, 'index'])->name('buku.create');
        Route::get('/admin/buku', [PerpustakaanController::class, 'index'])->name('admin.buku');
    });

    Route::get('/buku', [PerpustakaanController::class, 'index'])->middleware('permission:lihat daftar buku')->name('buku.index');
    Route::get('/buku/{id}', [PerpustakaanController::class, 'detail'])->middleware('permission:lihat daftar buku')->name('buku.detail');
    Route::get('/buku-cari', [PerpustakaanController::class, 'cari'])->name('buku.cari');

    // Pengajuan peminjaman hanya diberikan kepada Siswa melalui permission.
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->middleware('permission:mengajukan peminjaman buku')->name('peminjaman.store');

    // Siswa melihat riwayat sendiri; Admin dan Petugas dapat melihat serta mengelolanya.
    Route::get('/riwayat-peminjaman', [DashboardController::class, 'riwayat'])
        ->middleware('permission:melihat riwayat peminjaman sendiri|kelola peminjaman')
        ->name('riwayat');

    Route::put('/riwayat-peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'kembalikan'])
        ->middleware('permission:mencatat pengembalian buku')
        ->name('peminjaman.kembalikan');

    Route::delete('/riwayat-peminjaman/{peminjaman}', [PeminjamanController::class, 'destroy'])
        ->middleware('permission:kelola peminjaman')
        ->name('peminjaman.destroy');

    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->middleware('role:admin')->name('admin.dashboard');
    Route::get('/petugas/dashboard', [DashboardController::class, 'petugas'])->middleware('role:petugas')->name('petugas.dashboard');
    Route::get('/siswa/dashboard', [DashboardController::class, 'siswa'])->middleware('role:siswa')->name('siswa.dashboard');

    Route::middleware('permission:kelola data pengguna')->group(function () {
        Route::view('/admin/pengguna', 'admin.pengguna')->name('admin.pengguna');
    });
});