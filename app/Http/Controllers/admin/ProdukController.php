<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use DB;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::orderBy('id','DESC')->get();
        return view('admin.produk.index',compact('produk'));
    }

    public function create()
    {
        $rel_kategori = Kategori::orderBy('id','DESC')->get();
        return view('admin.produk.form',compact('rel_kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:45',
            'id_kategori' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg'
            ]);
            //Film::create($request->all());
            //---apakah user ingin upload image
            if(!empty($request->image)){
                $fileName=$request->nama.'.'.$request->image->extension();
                //$fileName=$request->image->getClientOriginalName();
                $request->image->move(public_path('admin/assets/image'),$fileName);
            }
            else{
                $fileName = '';
            }
            //insert data dari request form
            DB::table('produks')->insert(
                [
                    'nama' => $request->nama,
                    'id_kategori' => $request->id_kategori,
                    'harga' => $request->harga,
                    'stok' => $request->stok,
                    'image' => $fileName,
                    'created_at' => now(),
              ]);
                
            return redirect()->route('produk')
            ->with('success','Data Berhasil Disimpan');
    }
}
