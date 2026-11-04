@extends('layouts.app')
@section('content')
<div class="panel">
<h2>Dashboard Petugas</h2>
<p>Selamat datang, {{ auth()->user()->name }}. Kamu dapat mengelola buku, peminjaman, pengembalian, dan laporan.</p>
<a href="{{ route('buku.index') }}">Kelola data buku</a> |
<a href="{{ route('laporan.index') }}">Lihat laporan</a>
</div>
@endsection
