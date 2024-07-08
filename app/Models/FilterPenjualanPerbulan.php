<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterPenjualanPerbulan extends Model
{
    protected $table = 'filter_penjualan_perbulan'; 
    
    protected $fillable = [
        'id',
        'id_produk',
        'nama',
        'id_kategori',
        'harga',
        'image',
        'qty', 
    ];

    public function prediksi()
    {
        return $this->hasMany(Prediksi::class, 'id_produk', 'id');
    }
    
    

    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'id_kategori');
    }
}

