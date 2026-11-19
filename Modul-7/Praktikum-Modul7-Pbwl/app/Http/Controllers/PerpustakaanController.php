<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

public function cari(Request $request)
{
    $judul = $request->query('judul');
    $hasil = DB::select("SELECT * FROM bukus WHERE judul = ?", [$judul]);

    return response()->json($hasil);
}
    public function hapusRentan($buku)
{
    app(\App\Http\Controllers\Api\ApiBukuController::class)->destroy($buku);
    return redirect()->route('buku.index');
}
}