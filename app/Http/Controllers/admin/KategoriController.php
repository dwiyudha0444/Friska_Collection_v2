<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use DB;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::orderBy('id','DESC')->get();
        return view('admin.kategori.index',compact('kategori'));
    }



}
