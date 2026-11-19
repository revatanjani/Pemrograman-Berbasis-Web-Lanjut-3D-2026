<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function store(Request $request)
    {
        // Hanya Siswa yang boleh mengajukan peminjaman buku.
        abort_unless($request->user()->hasRole('siswa'), 403);

        $data = $request->validate([
            'buku_id' => ['required', 'integer', 'exists:bukus,id'],
        ]);

        $user = $request->user();
        $anggota = $user->anggota;

        // Buat atau hubungkan data anggota bila akun belum memiliki relasi anggota.
        if (! $anggota) {
            $anggota = Anggota::firstOrCreate(
                ['email' => $user->email],
                ['nama' => $user->name, 'no_telepon' => '-', 'user_id' => $user->id]
            );

            if (! $anggota->user_id) {
                $anggota->update(['user_id' => $user->id]);
            }

            if ((int) $anggota->user_id !== (int) $user->id) {
                return back()->withErrors([
                    'buku_id' => 'Data anggota tidak cocok dengan akun yang sedang login. Hubungi administrator.',
                ]);
            }
        }

        $masihDipinjam = Peminjaman::where('anggota_id', $anggota->id)
            ->where('buku_id', $data['buku_id'])
            ->whereNull('tanggal_kembali')
            ->exists();

        if ($masihDipinjam) {
            return back()->withErrors([
                'buku_id' => 'Kamu masih meminjam buku ini dan belum mengembalikannya.',
            ]);
        }

        $buku = Buku::findOrFail($data['buku_id']);

        Peminjaman::create([
            'anggota_id' => $anggota->id,
            'buku_id' => $buku->id,
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_kembali' => null,
        ]);

        return redirect()->route('riwayat')->with(
            'success',
            'Peminjaman buku "' . $buku->judul . '" berhasil dicatat.'
        );
    }

    /** Tandai buku telah dikembalikan oleh Admin atau Petugas. */
    public function kembalikan(Peminjaman $peminjaman)
    {
        abort_unless(auth()->user()->can('mencatat pengembalian buku'), 403);

        if ($peminjaman->tanggal_kembali) {
            return back()->with('success', 'Buku ini sudah tercatat dikembalikan.');
        }

        $peminjaman->update([
            'tanggal_kembali' => now()->toDateString(),
        ]);

        return redirect()->route('riwayat')->with('success', 'Pengembalian buku berhasil dicatat.');
    }

    /** Hapus catatan riwayat peminjaman oleh Admin atau Petugas. */
    public function destroy(Peminjaman $peminjaman)
    {
        abort_unless(auth()->user()->can('kelola peminjaman'), 403);

        $peminjaman->delete();

        return redirect()->route('riwayat')->with('success', 'Riwayat peminjaman berhasil dihapus.');
    }
public function show($id)
    {
        $peminjaman = Peminjaman::with(['anggota', 'buku'])->findOrFail($id);

        // Terapkan pengecekan otorisasi (mencegah IDOR)
        \Illuminate\Support\Facades\Gate::authorize('view', $peminjaman);

        return view('peminjaman.show', compact('peminjaman'));
    }
}
