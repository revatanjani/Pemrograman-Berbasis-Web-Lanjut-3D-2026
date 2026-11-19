<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Anggota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            ['name' => 'Administrator', 'email' => 'admin@ambabook.test', 'role' => 'admin'],
            ['name' => 'Petugas Perpustakaan', 'email' => 'petugas@ambabook.test', 'role' => 'petugas'],
            ['name' => 'Siswa Ambabook', 'email' => 'siswa@ambabook.test', 'role' => 'siswa'],
        ];

        foreach ($accounts as $account) {
            $user = User::firstOrCreate(
                ['email' => $account['email']],
                ['name' => $account['name'], 'password' => Hash::make('password')]
            );
            $user->syncRoles([$account['role']]);

            // Setiap akun yang dapat mengajukan peminjaman harus terhubung ke data anggota.
            if (! $user->anggota) {
                $anggota = Anggota::where('email', $user->email)->first();

                if ($anggota) {
                    if (! $anggota->user_id) {
                        $anggota->update(['user_id' => $user->id]);
                    }
                } else {
                    Anggota::create([
                        'nama' => $user->name,
                        'email' => $user->email,
                        'no_telepon' => '-',
                        'user_id' => $user->id,
                    ]);
                }
            }
        }
    }
}
