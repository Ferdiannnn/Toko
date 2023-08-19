<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'User_id',
        'Judul',
        'Kategori_id',
        'Deskripsi',
        'Harga',
        'Gambar',
        'Stok',
    ];

    protected $table = 'items';
}