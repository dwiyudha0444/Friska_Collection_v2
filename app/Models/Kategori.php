<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    
    protected $fillable = [
        'nama', 
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }

    public function prediksi()
    {
        return $this->hasMany(Prediksi::class);
    }

    public function filter()
    {
        return $this->hasMany(FilterPenjualanPerbulan::class);
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }
}
