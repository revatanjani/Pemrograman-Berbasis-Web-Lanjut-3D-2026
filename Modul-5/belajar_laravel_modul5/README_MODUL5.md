# Lanjutan Modul 5 — Autentikasi dan RBAC Ambabook

Project ini melanjutkan project Modul 4. Data dan fitur Modul 1–4 tidak dihapus.
Jangan menjalankan `migrate:fresh` karena perintah tersebut menghapus seluruh tabel dan data.

## Instalasi pertama pada komputer

1. Ekstrak folder project.
2. Buka terminal pada folder project.
3. Pastikan `.env` menunjuk ke database MySQL project yang sama (`belajar_laravel`).
4. Jalankan:

```bash
composer update
php artisan config:clear
php artisan migrate
php artisan db:seed
php artisan optimize:clear
php artisan serve
```

`composer update` diperlukan karena Modul 5 menambahkan `laravel/breeze` (scaffolding autentikasi) dan `spatie/laravel-permission` (RBAC). Setelah selesai, jalankan `npm install` dan `npm run build` bila ingin mengompilasi asset front-end.

## Akun uji

Semua password akun uji adalah `password`.

| Role | Email |
|---|---|
| Admin | admin@ambabook.test |
| Petugas | petugas@ambabook.test |
| Siswa | siswa@ambabook.test |

Registrasi dari halaman publik selalu membuat akun dengan role `siswa`. Form registrasi tidak menyediakan pilihan role.

## Hak akses

- Admin: dashboard admin, data buku, akun/role pengguna, peminjaman/pengembalian, laporan.
- Petugas: dashboard petugas, data buku, peminjaman/pengembalian, laporan. Tidak dapat mengelola pengguna atau role.
- Siswa: daftar/detail buku, profil sendiri, riwayat peminjaman sendiri. Tidak dapat mengelola buku atau melihat data peminjaman pengguna lain.

## Pengujian manual

- Belum login: buka `/admin/dashboard`, seharusnya dialihkan ke login.
- Login Admin: `/admin/dashboard` dapat dibuka; menu kelola buku, pengguna, dan laporan tersedia.
- Login Petugas: `/petugas/dashboard` dapat dibuka; `/admin/pengguna` ditolak.
- Login Siswa: `/siswa/dashboard`, daftar buku, profil, dan riwayat sendiri dapat dibuka; `/admin/dashboard` ditolak.
- Logout lalu buka halaman yang dilindungi: diarahkan kembali ke login.

## Catatan data peminjaman

Project Modul 4 menghubungkan peminjaman dengan tabel `anggotas`, bukan langsung dengan `users`. Modul 5 menambahkan `anggotas.user_id` agar akun Siswa dapat dipetakan ke satu data anggota. Riwayat Siswa difilter berdasarkan anggota yang terhubung dengan akun yang sedang login.
