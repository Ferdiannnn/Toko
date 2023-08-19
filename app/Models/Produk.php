<?php

namespace App\Models;

use App\Models\User;
use App\Models\Katagori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produks';
    protected $fillable = [
        'user_id',
        'Judul',
        'kategori_id',
        'Deskripsi',
        'Harga',
        'Gambar',
        'Stok',
    ];

    public function penjual()
    {
        return $this->belongsTo(User::class, 'id_penjual', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Katagori::class, 'kategori_id', 'id');
    }
}