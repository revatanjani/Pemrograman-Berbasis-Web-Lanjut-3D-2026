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
        $query = Peminjaman::with(['anggota', 'buku']);

        // Siswa hanya melihat peminjaman miliknya sendiri.
        // Admin dan Petugas dapat melihat seluruh riwayat anggota.
        if (auth()->user()->hasRole('siswa')) {
            $anggota = auth()->user()->anggota;
            $riwayat = $anggota
                ? $query->where('anggota_id', $anggota->id)->orderByDesc('tanggal_pinjam')->get()
                : collect();
        } else {
            $riwayat = $query->orderByDesc('tanggal_pinjam')->get();
        }

        return view('peminjaman.riwayat', compact('riwayat'));
    }
}
