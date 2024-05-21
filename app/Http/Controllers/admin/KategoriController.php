<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        // $produk = Produk::orderBy('id','DESC')->get();
        return view('admin.kategori.index');
    }

    
}
