<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    private function dataBuku()
    {
        return [
            ['id' => 1, 'judul' => 'Legenda Malin Kundang', 'penulis' => 'Aryastya Ikranegara', 'tahun' => 2022, 'kategori' => 'Folklore'],
            ['id' => 2, 'judul' => 'Timun Emas', 'penulis' => 'Rahma Asa', 'tahun' => 2021, 'kategori' => 'Folklore'],
            ['id' => 3, 'judul' => 'Negeri 5 Menara', 'penulis' => 'Ahmad Fuadi', 'tahun' => 2009, 'kategori' => 'Novel'],
            ['id' => 4, 'judul' => 'Islam Ala Prabowo', 'penulis' => 'Rizal Dikri', 'tahun' => 2025, 'kategori' => 'Politik & Sosial'],
            ['id' => 5, 'judul' => 'Bumi', 'penulis' => 'Tere Liye', 'tahun' => 2014, 'kategori' => 'Fiksi/Fantasi'],
        ];
    }

    public function index()
    {
        $buku = $this->dataBuku();
        return view('buku.index', ['buku' => $buku]);
    }

    public function detail($id)
    {
        $buku = null;
        foreach ($this->dataBuku() as $barang) {
            if ($barang['id'] == $id) {
                $buku = $barang;
                break;
            }
        }
        return view('buku.detail', ['buku' => $buku]);
    }
}