<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrediksiController extends Controller
{
    public function index()
    {
        // $produk = Produk::orderBy('id','DESC')->get();
        return view('admin.prediksi.index');
    }
}
