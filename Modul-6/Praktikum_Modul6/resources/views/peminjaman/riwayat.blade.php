@extends('layouts.app')

@section('content')
<div class="panel">
    <h2>Riwayat Peminjaman</h2>

    @role('siswa')
        <p>Berikut daftar buku yang pernah kamu pinjam.</p>
    @else
        <p>Admin dan Petugas dapat mengelola seluruh riwayat peminjaman.</p>
    @endrole

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nama Peminjam</th>
                    <th>Nama Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    @if(auth()->user()->can('kelola peminjaman') || auth()->user()->can('mencatat pengembalian buku'))
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat as $item)
                    <tr>
                        <td>{{ $item->anggota->nama ?? '-' }}</td>
                        <td>{{ $item->buku->judul ?? '-' }}</td>
                        <td>{{ $item->tanggal_pinjam ? \Illuminate\Support\Carbon::parse($item->tanggal_pinjam)->format('Y-m-d') : '-' }}</td>
                        <td>{{ $item->tanggal_kembali ? \Illuminate\Support\Carbon::parse($item->tanggal_kembali)->format('Y-m-d') : '-' }}</td>

                        @if(auth()->user()->can('kelola peminjaman') || auth()->user()->can('mencatat pengembalian buku'))
                            <td class="aksi">
                                @if(auth()->user()->can('mencatat pengembalian buku') && !$item->tanggal_kembali)
                                    <form method="POST" action="{{ route('peminjaman.kembalikan', $item) }}" style="display:inline" onsubmit="return confirm('Catat buku ini sudah dikembalikan?')">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary">Tandai Dikembalikan</button>
                                    </form>
                                @elseif($item->tanggal_kembali)
                                    <span>Sudah Dikembalikan</span>
                                @endif

                                @can('kelola peminjaman')
                                    <form method="POST" action="{{ route('peminjaman.destroy', $item) }}" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus riwayat peminjaman ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">Hapus</button>
                                    </form>
                                @endcan
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->can('kelola peminjaman') || auth()->user()->can('mencatat pengembalian buku') ? 5 : 4 }}">
                            Belum ada riwayat peminjaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
