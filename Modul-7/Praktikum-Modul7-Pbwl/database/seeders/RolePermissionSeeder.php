<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Permission laporan dihapus karena menu dan halaman Laporan tidak digunakan lagi.
        Permission::where('name', 'lihat laporan perpustakaan')->where('guard_name', 'web')->delete();

        $permissions = [
            'akses dashboard admin', 'akses dashboard petugas', 'lihat daftar buku',
            'kelola data buku', 'kelola data pengguna', 'kelola role pengguna',
            'kelola peminjaman', 'kelola pengembalian', 'mengajukan peminjaman buku',
            'memproses persetujuan peminjaman', 'mencatat pengembalian buku',
            'melihat status peminjaman sendiri', 'melihat riwayat peminjaman sendiri',
            'lihat profil sendiri', 'ubah profil sendiri',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $petugas = Role::firstOrCreate(['name' => 'petugas', 'guard_name' => 'web']);
        $siswa = Role::firstOrCreate(['name' => 'siswa', 'guard_name' => 'web']);

        // Admin dan Petugas mengelola catatan peminjaman/pengembalian,
        // tetapi tidak mengajukan pinjaman sebagai peminjam.
        $admin->syncPermissions(array_values(array_diff($permissions, [
            'mengajukan peminjaman buku',
        ])));

        $petugas->syncPermissions([
            'akses dashboard petugas', 'lihat daftar buku', 'kelola data buku',
            'kelola peminjaman', 'kelola pengembalian',
            'memproses persetujuan peminjaman', 'mencatat pengembalian buku',
            'melihat status peminjaman sendiri', 'melihat riwayat peminjaman sendiri',
            'lihat profil sendiri', 'ubah profil sendiri',
        ]);
        $siswa->syncPermissions([
            'lihat daftar buku', 'mengajukan peminjaman buku',
            'melihat status peminjaman sendiri', 'melihat riwayat peminjaman sendiri',
            'lihat profil sendiri', 'ubah profil sendiri',
        ]);
    }
}
