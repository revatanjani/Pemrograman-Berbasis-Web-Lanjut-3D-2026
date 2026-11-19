<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Anggota;
class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
    Anggota::factory(3)->create();
    }
}
