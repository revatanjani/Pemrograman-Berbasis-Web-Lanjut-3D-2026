REVISI PEMINJAMAN DAN PENGELOLAAN RIWAYAT

Aturan akses:
1. Hanya role Siswa yang dapat mengajukan peminjaman buku.
2. Admin dan Petugas dapat melihat seluruh riwayat peminjaman.
3. Admin dan Petugas dapat menandai buku sudah dikembalikan. Tanggal kembali diisi otomatis dengan tanggal saat tombol digunakan.
4. Admin dapat menghapus catatan riwayat peminjaman. Petugas juga memiliki permission kelola peminjaman dan dapat menghapus catatan riwayat.
5. Siswa hanya dapat melihat riwayat peminjamannya sendiri dan tidak melihat tombol pengelolaan.

File yang diubah:
- routes/web.php
- app/Http/Controllers/PeminjamanController.php
- database/seeders/RolePermissionSeeder.php
- resources/views/peminjaman/riwayat.blade.php

Setelah menyalin project ke komputer, jalankan:
php artisan db:seed --class=RolePermissionSeeder
php artisan optimize:clear
php artisan serve

Seeder memperbarui permission role tanpa menghapus data buku, anggota, atau peminjaman. Tidak perlu menjalankan migrate:fresh.
