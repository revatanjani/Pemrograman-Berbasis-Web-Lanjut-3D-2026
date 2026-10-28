<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiBukuController;

Route::get('/kategori', [ApiBukuController::class, 'kategori']);
Route::apiResource('buku', ApiBukuController::class)->names('api.buku');

Route::get('/rekap/buku-per-kategori', [ApiBukuController::class, 'rekapBukuPerKategori']);
Route::get('/rekap/peminjaman-per-buku', [ApiBukuController::class, 'rekapPeminjamanPerBuku']);
