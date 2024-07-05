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
        'id_periode',
        'qty',
        'ma',
        'mse',
        'mad',
        'mape',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'id_kategori');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class,'id_periode');
    }
}
