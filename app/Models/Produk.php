<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';
    
    protected $fillable = [
        'nama',
        'id_kategori',
        'harga',
        'image',
        'stok', 
        'tgl', 
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'id_kategori');
    }
}
