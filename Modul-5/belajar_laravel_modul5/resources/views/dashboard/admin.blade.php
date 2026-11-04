@extends('layouts.app')
@section('content')
<div class="panel">
<h2>Dashboard Admin</h2>
<p>Selamat datang, {{ auth()->user()->name }}. Kamu memiliki akses administrasi penuh.</p>
<ul>
<li><a href="{{ route('buku.index') }}">Kelola data buku</a></li>
<li><a href="{{ route('admin.pengguna') }}">Kelola akun dan role pengguna</a></li>
<li><a href="{{ route('laporan.index') }}">Laporan perpustakaan</a></li>
</ul>
</div>
@endsection
