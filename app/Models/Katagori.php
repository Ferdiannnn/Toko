<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Katagori extends Model
{
    use HasFactory;

    protected $table = 'kategori';



    public function namakategori()
    {
        return $this->hasMany(Produk::class, 'kategori_id', 'id');
    }
}