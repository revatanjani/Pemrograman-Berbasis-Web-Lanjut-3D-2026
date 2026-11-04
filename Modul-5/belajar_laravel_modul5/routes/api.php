<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiBukuController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/kategori', [ApiBukuController::class, 'kategori'])
        ->middleware('permission:lihat daftar buku');

    Route::get('/buku', [ApiBukuController::class, 'index'])
        ->middleware('permission:lihat daftar buku')->name('api.buku.index');
    Route::get('/buku/{buku}', [ApiBukuController::class, 'show'])
        ->middleware('permission:lihat daftar buku')->name('api.buku.show');

    Route::post('/buku', [ApiBukuController::class, 'store'])
        ->middleware('permission:kelola data buku')->name('api.buku.store');
    Route::put('/buku/{buku}', [ApiBukuController::class, 'update'])
        ->middleware('permission:kelola data buku')->name('api.buku.update');
    Route::patch('/buku/{buku}', [ApiBukuController::class, 'update'])
        ->middleware('permission:kelola data buku')->name('api.buku.patch');
    Route::delete('/buku/{buku}', [ApiBukuController::class, 'destroy'])
        ->middleware('permission:kelola data buku')->name('api.buku.destroy');

    Route::get('/rekap/buku-per-kategori', [ApiBukuController::class, 'rekapBukuPerKategori'])
        ->middleware('permission:lihat laporan perpustakaan');
    Route::get('/rekap/peminjaman-per-buku', [ApiBukuController::class, 'rekapPeminjamanPerBuku'])
        ->middleware('permission:lihat laporan perpustakaan');
});
