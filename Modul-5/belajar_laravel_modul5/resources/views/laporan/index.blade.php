@extends('layouts.app')
@section('content')
<div class="panel">
<h2>Laporan Perpustakaan</h2>
<table><thead><tr><th>Anggota</th><th>Buku</th><th>Tanggal Pinjam</th><th>Tanggal Kembali</th></tr></thead>
<tbody>
@forelse($peminjamans as $item)
<tr><td>{{ $item->anggota->nama ?? '-' }}</td><td>{{ $item->buku->judul ?? '-' }}</td><td>{{ $item->tanggal_pinjam }}</td><td>{{ $item->tanggal_kembali ?? '-' }}</td></tr>
@empty<tr><td colspan="4">Belum ada data peminjaman.</td></tr>@endforelse
</tbody></table>
</div>
@endsection
