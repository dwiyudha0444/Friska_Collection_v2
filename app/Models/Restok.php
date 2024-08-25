<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restok extends Model
{
    protected $table = 'produks';
    
    protected $fillable = [
        'nama',
        'id_kategori',
        'harga',
        'image',
        'stok', 
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'id_kategori');
    }
}
