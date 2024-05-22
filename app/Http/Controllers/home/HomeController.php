<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $produk = Produk::orderBy('id','DESC')->get();
        return view('home.home',compact('produk'));
    }
}