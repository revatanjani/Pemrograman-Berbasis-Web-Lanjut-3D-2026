<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiBukuController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route API Buku
Route::apiResource('buku', ApiBukuController::class);


Route::apiResource('buku', ApiBukuController::class)->names('api.buku');
Route::get('/rekap/buku-per-kategori', [RekapController::class, 'bukuPerKategori']);
Route::get('/rekap/pemminjaman-per-buku', [RekapController::class, 'peminjamanPerBuku']);
Route::get('rekap/buku-per-kategori', [ApiBukuController::class, 'rekapBukuPerKategori']);
Route::get('rekap/peminjaman-per-buku', [ApiBukuController::class, 'rekapPeminjamanPerBuku']);