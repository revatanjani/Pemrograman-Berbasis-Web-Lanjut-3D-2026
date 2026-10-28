<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;

class PerpustakaanController extends Controller
{
    public function index()
    {
        $buku = Buku::with('kategori')->get();
        $peminjaman = Peminjaman::with(['anggota', 'buku'])->get();

        return view('buku.index', compact('buku', 'peminjaman'));
    }

    public function detail($id)
    {
        $buku = Buku::with('kategori')->findOrFail($id);

        return view('buku.detail', compact('buku'));
    }
    public function home()
{
    return view('home');
}
}