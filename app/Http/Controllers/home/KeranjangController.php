<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keranjang;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = Keranjang::orderBy('id','DESC')->get();
        return view('home.keranjang.index',compact('keranjang'));
    }

    public function store(Request $request)
    {
        // Validasi data form
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_kategori' => 'required',
            'image' => 'required',
            'harga' => 'required',
            'qty' => 'required',
        ]);

        // Simpan data ke dalam database Kategori
        Keranjang::create([
            'nama' => $request->nama,
            'id_kategori' => $request->id_kategori,
            'image' => $request->image,
            'harga' => $request->harga,
            'qty' => $request->qty,
        ]);

        // Response sukses
        return redirect('/landingpage')->with('success', 'Berhasil Menambahkan Ke Keranjang');
    }
}