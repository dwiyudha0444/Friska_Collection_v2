<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediksi extends Model
{
    protected $table = 'prediksis';
    
    protected $fillable = [
        'id_produk',
        'nama',
        'id_kategori',
        'harga',
        'qty', 
    ];
}
