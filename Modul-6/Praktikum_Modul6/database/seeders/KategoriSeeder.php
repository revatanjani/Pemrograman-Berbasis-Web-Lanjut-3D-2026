<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            'Fiksi/Fantasi',
            'Folklore',
            'Novel',
            'Politik & Sosial',
            'Pendidikan',
            'Teknologi',
            'Sejarah',
        ];

        foreach ($kategori as $nama) {
            Kategori::firstOrCreate([
                'nama' => $nama,
            ]);
        }
    }
}
