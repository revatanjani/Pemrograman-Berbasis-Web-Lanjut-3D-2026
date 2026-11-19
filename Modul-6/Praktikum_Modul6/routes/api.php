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

    // Bagian yang diganti menggunakan Gate 'can:kelola-buku':
    Route::post('/buku', [ApiBukuController::class, 'store'])
        ->middleware('can:kelola-buku')->name('api.buku.store');
    Route::put('/buku/{buku}', [ApiBukuController::class, 'update'])
        ->middleware('can:kelola-buku')->name('api.buku.update');
    Route::patch('/buku/{buku}', [ApiBukuController::class, 'update'])
        ->middleware('can:kelola-buku')->name('api.buku.patch');
    Route::delete('/buku/{buku}', [ApiBukuController::class, 'destroy'])
        ->middleware('can:kelola-buku')->name('api.buku.destroy');
}); 