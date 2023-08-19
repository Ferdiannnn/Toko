<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'produk_id',
        'jumlah'
    ];


    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}