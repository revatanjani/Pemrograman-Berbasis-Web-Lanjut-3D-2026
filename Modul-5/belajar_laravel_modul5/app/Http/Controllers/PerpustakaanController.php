<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;

class PerpustakaanController extends Controller
{
    public function index()
    {
        // Data daftar buku dimuat dari endpoint /api/buku melalui Fetch API.
        return view('buku.index');
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