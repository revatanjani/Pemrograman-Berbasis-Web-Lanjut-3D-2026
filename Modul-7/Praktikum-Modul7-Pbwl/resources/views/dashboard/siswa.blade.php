@extends('layouts.app')
@section('content')
<div class="panel">
<h2>Dashboard Siswa</h2>
<p>Selamat datang, {{ auth()->user()->name }}.</p>
<p><a href="{{ route('buku.index') }}">Lihat daftar buku</a> · <a href="{{ route('profile.edit') }}">Perbarui profil</a> · <a href="{{ route('riwayat') }}">Riwayat peminjaman saya</a></p>
</div>
@endsection
