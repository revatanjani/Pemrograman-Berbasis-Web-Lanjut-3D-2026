@extends('layouts.app')
@section('content')
<div class="panel">
<h2>Dashboard Petugas</h2>
<p>Selamat datang, {{ auth()->user()->name }}. Kamu dapat mengelola buku dan kegiatan peminjaman perpustakaan.</p>
<a href="{{ route('buku.index') }}">Kelola data buku</a>
</div>
@endsection
