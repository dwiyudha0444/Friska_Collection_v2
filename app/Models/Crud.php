<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    protected $table = 'crud';
    
    protected $fillable = [
        'nama', 
        'nim',
        'kelas',  
    ];
}
