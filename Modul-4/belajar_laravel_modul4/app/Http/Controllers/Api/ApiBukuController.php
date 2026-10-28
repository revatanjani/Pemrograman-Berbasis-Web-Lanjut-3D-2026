<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BukuResource;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiBukuController extends Controller
{
    public function index(Request $request)
    {
        $buku = Buku::with('kategori')
            ->when($request->filled('cari'), function ($query) use ($request) {
                $cari = $request->cari;
                $query->where(function ($q) use ($cari) {
                    $q->where('judul', 'like', "%{$cari}%")
                        ->orWhere('penulis', 'like', "%{$cari}%");
                });
            })
            ->latest('id')
            ->paginate(10);

        return BukuResource::collection($buku);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'judul' => ['required', 'string', 'min:3', 'max:150'],
            'penulis' => ['required', 'string', 'min:3', 'max:100'],
            'tahun_terbit' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'judul.required' => 'Judul buku wajib diisi.',
            'judul.min' => 'Judul buku minimal 3 karakter.',
            'penulis.required' => 'Penulis wajib diisi.',
            'penulis.min' => 'Nama penulis minimal 3 karakter.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.min' => 'Tahun terbit tidak boleh sebelum 1900.',
            'tahun_terbit.max' => 'Tahun terbit tidak boleh melebihi tahun sekarang.',
        ]);

        $buku = Buku::create($data);
        $buku->load('kategori');

        return (new BukuResource($buku))
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $buku = Buku::with('kategori')->findOrFail($id);

        return new BukuResource($buku);
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $data = $request->validate([
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'judul' => ['required', 'string', 'min:3', 'max:150'],
            'penulis' => ['required', 'string', 'min:3', 'max:100'],
            'tahun_terbit' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'judul.required' => 'Judul buku wajib diisi.',
            'judul.min' => 'Judul buku minimal 3 karakter.',
            'penulis.required' => 'Penulis wajib diisi.',
            'penulis.min' => 'Nama penulis minimal 3 karakter.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.min' => 'Tahun terbit tidak boleh sebelum 1900.',
            'tahun_terbit.max' => 'Tahun terbit tidak boleh melebihi tahun sekarang.',
        ]);

        $buku->update($data);
        $buku->load('kategori');

        return new BukuResource($buku);
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return response()->noContent();
    }

    public function kategori()
    {
        return response()->json([
            'data' => Kategori::orderBy('nama')->get(['id', 'nama']),
        ]);
    }

    public function rekapBukuPerKategori()
    {
        $rekap = DB::table('kategoris')
            ->leftJoin('bukus', 'kategoris.id', '=', 'bukus.kategori_id')
            ->select('kategoris.nama', DB::raw('count(bukus.id) as total_buku'))
            ->groupBy('kategoris.id', 'kategoris.nama')
            ->get();

        return response()->json(['status' => 'success', 'data' => $rekap]);
    }

    public function rekapPeminjamanPerBuku()
    {
        $rekap = Buku::withCount('peminjamans')->get(['id', 'judul', 'peminjamans_count']);

        return response()->json(['status' => 'success', 'data' => $rekap]);
    }
}