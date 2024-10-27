<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualans';
    
    protected $fillable = [
        'id_produk',
        'nama',
        'id_kategori',
        'harga',
        'image',
        'qty', 
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'id_kategori');
    }
}
