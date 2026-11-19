<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class kampus extends Model
{
    use HasFactory;
    protected $table = 'tabel_kampus';
    protected $fillable= ['gedung'];
}
