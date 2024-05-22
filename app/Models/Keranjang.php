<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjangs';
    
    protected $fillable = [
        'nama',
        'id_kategori',
        'harga',
        'image',
        'qty', 
    ];
}
