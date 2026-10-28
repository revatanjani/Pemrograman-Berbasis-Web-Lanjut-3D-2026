@extends('layouts.app')

@section('content')
<h2>Detail Buku</h2>

<h3>{{ $buku->judul }}</h3>
<p>Penulis: {{ $buku->penulis }}</p>
<p>Tahun Terbit: {{ $buku->tahun_terbit ?? $buku->tahun }}</p>
<p>Kategori: {{ $buku->kategori->nama ?? $buku->kategori }}</p>

<a href="{{ route('buku.index') }}" style="display: inline-block; background-color: #3b82f6; color: white; padding: 6px 14px; border-radius: 4px; text-decoration: none; font-size: 0.9em; font-weight: 500;">Kembali</a>
@endsection