<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class HitungPrediksiController extends Controller
{
    public function index()
    {
        return view('admin.prediksi.hitung.index');
    }

    public function indexBulanDepan()
    {
        $produkList = Produk::pluck('nama', 'id')->toArray(); 
        return view('admin.prediksi.hitung.BulanDepan.index', compact('produkList'));
    }

    public function indexHasil()
    {
        return view('admin.prediksi.hitung.BulanDepan.hasil');
    }
}
