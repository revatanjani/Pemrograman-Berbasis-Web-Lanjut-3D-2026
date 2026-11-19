@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="panel auth-box">
    <h2>Login Ambabook</h2>
    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <div class="form-group"><label>Email</label><input type="email" name="email" value="{{ old('email') }}" required autofocus></div>
        <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
        <div class="form-actions"><button class="btn btn-primary">Login</button></div>
    </form>
    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>.</p>
</div>
@endsection
