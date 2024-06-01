<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Prediksi;
use DB;

class PrediksiController extends Controller
{
    public function index()
    {
        $produk = Produk::orderBy('id','DESC')->get();
        return view('admin.produk.index',compact('produk'));
    }

    public function test()
    {
        return view('admin.prediksi.test');
    }

    public function create()
    {
        $rel_produk = Prediksi::orderBy('id','DESC')->get();
        return view('admin.produk.form',compact('rel_produk'));
    }
}
