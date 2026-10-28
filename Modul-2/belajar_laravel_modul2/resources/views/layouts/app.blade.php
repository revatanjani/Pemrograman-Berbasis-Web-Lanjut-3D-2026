<!DOCTYPE html>
<html>
<head>
    <title> Ambabook</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {5
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
        <a href="{{ route('buku.index') }}">Daftar Buku</a>
    </nav>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>


</body>
</html>