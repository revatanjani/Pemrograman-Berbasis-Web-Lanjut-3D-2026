@extends('layouts.app')

@section('content')
<div class="page-heading">
    <h2>Detail Peminjaman #{{ $peminjaman->id }}</h2>
</div>

<section class="panel">
    <p><strong>Nama Peminjam:</strong> {{ $peminjaman->anggota->nama ?? '-' }}</p>
    <p><strong>Email Peminjam:</strong> {{ $peminjaman->anggota->email ?? '-' }}</p>
    <p><strong>Judul Buku:</strong> {{ $peminjaman->buku->judul ?? '-' }}</p>
    <p><strong>Tanggal Pinjam:</strong> {{ $peminjaman->tanggal_pinjam }}</p>
    <p><strong>Tanggal Kembali:</strong> {{ $peminjaman->tanggal_kembali ?? 'Belum dikembalikan' }}</p>

    <div class="form-actions" style="margin-top: 1rem;">
        <a href="{{ route('riwayat') }}" class="btn btn-secondary">Kembali ke Riwayat</a>
    </div>
</section>
@endsection