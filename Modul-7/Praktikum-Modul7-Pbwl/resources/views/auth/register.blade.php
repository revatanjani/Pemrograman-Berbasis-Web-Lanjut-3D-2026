@extends('layouts.app')
@section('title', 'Registrasi')
@section('content')
<div class="panel auth-box">
    <h2>Registrasi Siswa</h2>
    <p>Akun yang didaftarkan melalui halaman ini otomatis mendapatkan role Siswa.</p>
    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <div class="form-group"><label>Nama</label><input name="name" value="{{ old('name') }}" required></div>
        <div class="form-group"><label>Email</label><input type="email" name="email" value="{{ old('email') }}" required></div>
        <div class="form-group"><label>No. Telepon</label><input name="no_telepon" value="{{ old('no_telepon') }}"></div>
        <div class="form-group"><label>Password (minimal 8 karakter)</label><input type="password" name="password" required></div>
        <div class="form-group"><label>Konfirmasi Password</label><input type="password" name="password_confirmation" required></div>
        <div class="form-actions"><button class="btn btn-primary">Daftar</button></div>
    </form>
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a>.</p>
</div>
@endsection
