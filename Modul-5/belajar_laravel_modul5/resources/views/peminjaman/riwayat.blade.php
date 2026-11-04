@extends('layouts.app')
@section('content')
<div class="panel">
<h2>Riwayat Peminjaman Saya</h2>
<table>
<thead><tr><th>Buku</th><th>Tanggal Pinjam</th><th>Tanggal Kembali</th><th>Status</th></tr></thead>
<tbody>
@forelse($riwayat as $item)
<tr><td>{{ $item->buku->judul ?? '-' }}</td><td>{{ $item->tanggal_pinjam }}</td><td>{{ $item->tanggal_kembali ?? '-' }}</td><td>{{ $item->tanggal_kembali ? 'Dikembalikan' : 'Dipinjam' }}</td></tr>
@empty
<tr><td colspan="4">Belum ada riwayat peminjaman.</td></tr>
@endforelse
</tbody>
</table>
</div>
@endsection
