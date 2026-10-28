<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus';
    protected $fillable = ['kategori_id', 'judul', 'penulis', 'tahun_terbit'];
    public function kategori()
    {
  return $this->belongsTo(Kategori::class);
    }
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}