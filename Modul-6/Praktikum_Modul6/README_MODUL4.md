# Ambabook — Praktikum Modul 4 RESTful API dan Konsumsi API

Project ini merupakan kelanjutan project Laravel modul 1–3. Halaman `/buku` sekarang mengambil dan mengelola data buku melalui RESTful API menggunakan Fetch API dan `async/await`.

## Fitur tugas Modul 4

1. Menampilkan daftar buku dari `GET /api/buku`.
2. Menambahkan buku melalui `POST /api/buku`.
3. Mengubah buku melalui `PUT /api/buku/{id}`.
4. Menghapus buku melalui `DELETE /api/buku/{id}` dengan konfirmasi.
5. Menangani kesalahan jaringan, validasi, dan status HTTP menggunakan `response.ok` serta `try/catch`.
6. Menggunakan `BukuResource` untuk menentukan struktur JSON dan `$request->validate()` untuk validasi tambah/ubah.

## Pemetaan API Resource

File `app/Http/Resources/BukuResource.php` mengirim atribut `kategori` berdasarkan relasi kategori (`kategoris.nama`), bukan nama kolom `kategori_id` pada tabel `bukus`. Dengan begitu, nama atribut respons API dapat berbeda dari nama kolom database. Atribut `judul`, `penulis`, dan `tahun_terbit` mengambil nilai dari kolom terkait pada tabel `bukus`.

## Cara menjalankan di Laragon

1. Ekstrak folder project ke folder web Laragon, misalnya `C:\laragon\www\belajar_laravel`.
2. Salin `.env.example` menjadi `.env`.
3. Buat database MySQL bernama `belajar_laravel` melalui phpMyAdmin, lalu atur bagian database di `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=belajar_laravel
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. Buka terminal pada folder project, lalu jalankan:

   ```bash
   composer install
   php artisan key:generate
   php artisan migrate --seed
   ```

5. Jalankan situs melalui Laragon (Auto Virtual Hosts) atau gunakan:

   ```bash
   php artisan serve
   ```

6. Buka `http://127.0.0.1:8000/buku` (atau alamat virtual host project Laragon diikuti `/buku`).

## Endpoint API

- `GET /api/buku`
- `GET /api/buku/{id}`
- `POST /api/buku`
- `PUT /api/buku/{id}`
- `DELETE /api/buku/{id}`
- `GET /api/kategori` untuk mengisi pilihan kategori pada formulir

Catatan: file `.env` lokal tidak disertakan di arsip. Buat dari `.env.example` dan sesuaikan konfigurasi database di komputer sendiri.
