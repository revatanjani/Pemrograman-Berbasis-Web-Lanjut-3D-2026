@extends('layouts.app')
@section('content')
<div class="panel">
    <h2>Profil Saya</h2>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf @method('PUT')
        <div class="form-group"><label>Nama</label><input name="name" value="{{ old('name', $user->name) }}" required></div>
        <div class="form-group"><label>Email</label><input type="email" name="email" value="{{ old('email', $user->email) }}" required></div>
        <div class="form-group"><label>No. Telepon</label><input name="no_telepon" value="{{ old('no_telepon', $anggota->no_telepon ?? '') }}"></div>
        <button class="btn btn-primary">Simpan Profil</button>
    </form>
</div>
@endsection
