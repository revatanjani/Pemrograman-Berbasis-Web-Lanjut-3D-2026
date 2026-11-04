<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function admin()
    {
        abort_unless(auth()->user()->can('akses dashboard admin'), 403);
        return view('dashboard.admin');
    }

    public function petugas()
    {
        abort_unless(auth()->user()->can('akses dashboard petugas'), 403);
        return view('dashboard.petugas');
    }

    public function siswa()
    {
        return view('dashboard.siswa');
    }

    public function riwayat()
    {
        $anggota = auth()->user()->anggota;
        $riwayat = $anggota ? Peminjaman::with('buku')->where('anggota_id', $anggota->id)->latest()->get() : collect();
        return view('peminjaman.riwayat', compact('riwayat'));
    }

    public function laporan()
    {
        abort_unless(auth()->user()->can('lihat laporan perpustakaan'), 403);
        $peminjamans = Peminjaman::with(['buku', 'anggota'])->latest()->get();
        return view('laporan.index', compact('peminjamans'));
    }
}
