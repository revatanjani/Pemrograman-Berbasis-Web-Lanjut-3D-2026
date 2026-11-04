<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Hindari menjalankan ulang factory Modul 1-4 agar data lama tidak terduplikasi.
        $this->call([RolePermissionSeeder::class, UserSeeder::class]);
    }
}
