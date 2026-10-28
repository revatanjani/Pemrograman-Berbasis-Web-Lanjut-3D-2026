<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpustakaanController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/buku', [PerpustakaanController::class, 'index'])->name('buku.index');
Route::get('/buku/{id}', [PerpustakaanController::class, 'detail'])->name('buku.detail');