@extends('layouts.app')

@section('content')
<h2>Daftar Buku</h2>

@foreach ($buku as $barang)
    <x-kartu-buku
        :id="$barang->id"
        :judul="$barang->judul"
        :penulis="$barang->penulis"
        :tahun="$barang->tahun_terbit ?? $barang->tahun"
    />
@endforeach

<hr>

<h2>Daftar Peminjaman</h2>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Anggota</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peminjaman as $index => $p)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $p->anggota->nama ?? '-' }}</td>
            <td>{{ $p->buku->judul ?? '-' }}</td>
            <td>{{ $p->tanggal_pinjam }}</td>
            <td>{{ $p->tanggal_kembali }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection