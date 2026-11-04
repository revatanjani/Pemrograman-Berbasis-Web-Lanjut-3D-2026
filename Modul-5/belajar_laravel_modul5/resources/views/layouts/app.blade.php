<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Ambabook</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        header {
            background-color: #de23ac;
            color: white;
            padding: 20px;
            text-align: center;
        }

        nav {
            background-color: #97307d;
            padding: 15px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        main {
            padding: 30px 0;
        }

        .page-heading p { color: #666; margin-top: -8px; }
        .panel {
            background: white;
            border: 1px solid #e4e4e4;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
        }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group label { font-weight: bold; }
        .form-group input, .form-group select {
            box-sizing: border-box;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-actions, .table-heading { display: flex; align-items: center; gap: 10px; }
        .form-actions { margin-top: 18px; }
        .table-heading { justify-content: space-between; }
        .table-heading h3 { margin: 0; }
        .btn {
            border: 0;
            border-radius: 5px;
            padding: 9px 13px;
            cursor: pointer;
            color: white;
            font-size: 14px;
        }
        .btn-primary { background: #de23ac; }
        .auth-box { max-width: 460px; margin: 35px auto; }
        .auth-box input { box-sizing: border-box; width: 100%; padding: 11px; border: 1px solid #ccc; border-radius: 5px; }
        .auth-box .form-group { margin: 14px 0; }
        .auth-box a { color: #97307d; }
        .btn-secondary { background: #64748b; }
        .btn-edit { background: #d97706; margin-right: 5px; }
        .btn-delete { background: #dc2626; }
        .table-wrap { overflow-x: auto; margin-top: 15px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 11px; border: 1px solid #ddd; text-align: left; }
        th { background: #f8e7f4; }
        .pesan { padding: 12px 15px; border-radius: 6px; margin: 15px 0; }
        .pesan.success { color: #166534; background: #dcfce7; }
        .pesan.error { color: #991b1b; background: #fee2e2; }
        [hidden] { display: none !important; }
        @media (max-width: 650px) {
            .container { width: 92%; }
            .form-grid { grid-template-columns: 1fr; }
            .panel { padding: 14px; }
        }

        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 15px;
        }

        .card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .detail-button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
        }

        .detail-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>

    <header>
        <h1>PERPUSTAKAAN AMBABOOK</h1>
    </header>

    <nav>
        <a href="{{ route('home') }}">Beranda</a>
        @auth
            <a href="{{ route('buku.index') }}">Daftar Buku</a>
            <a href="{{ route('profile.edit') }}">Profil</a>
            <a href="{{ route('riwayat') }}">Riwayat Peminjaman</a>
            @role('admin')<a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>@endrole
            @role('petugas')<a href="{{ route('petugas.dashboard') }}">Dashboard Petugas</a>@endrole
            @role('siswa')<a href="{{ route('siswa.dashboard') }}">Dashboard Siswa</a>@endrole
            @can('lihat laporan perpustakaan')<a href="{{ route('laporan.index') }}">Laporan</a>@endcan
            <form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf<button class="btn btn-secondary" type="submit">Logout</button></form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Registrasi</a>
        @endauth
    </nav>

    <main>
        <div class="container">
            @if(session('success'))<div class="pesan success">{{ session('success') }}</div>@endif
            @if($errors->any())<div class="pesan error">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>@endif
            @yield('content')
        </div>
    </main>


    @stack('scripts')
</body>
</html>