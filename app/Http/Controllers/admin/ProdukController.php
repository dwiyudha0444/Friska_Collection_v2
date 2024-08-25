<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Restok;
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
        $nextId = Produk::max('id') + 1;
        $kode = 'KD-' . $nextId;

        return view('admin.produk.form',compact('rel_kategori','kode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:45',
            'kode' => 'required',
            'id_kategori' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg',
            'tgl' => 'required',
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
                    'kode' => $request->kode,
                    'id_kategori' => $request->id_kategori,
                    'harga' => $request->harga,
                    'stok' => $request->stok,
                    'image' => $fileName,
                    'tgl' => $request->tgl,
                    'created_at' => now(),
              ]);
                
            return redirect()->route('produk')
            ->with('success','Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $produk = Produk::find($id);
        $rel_kategori = Kategori::orderBy('id', 'DESC')->get();
        return view('admin.produk.form_edit', compact('produk', 'rel_kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|max:45',
            'kode' => 'required',
            'id_kategori' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg'
            ]);
            //Film::create($request->all());
            //---ambil image lama
            $image = DB::table('produks')->select('image')->where('id',$id)->get();
            foreach($image as $co){
                $namaFileFotoLama = $co->image;
            }
            //---aoakah user ingin ganti image lama
            if(!empty($request->image)){
                //jika ada image lama , hapus terlebih dahulu
                if(!empty($ta->image)) unlink('admin/assets/image'.$ta->image);
                //image lama ganti image baru
                $fileName=$request->judul.'.'.$request->image->extension();
                //$fileName=$request->image->getClientOriginalName();
                $request->image->move(public_path('admin/assets/image'),$fileName);
            }
            //---user tidak ganti image lama
            else{
                $fileName = $namaFileFotoLama;
            }
            DB::table('produks')->where('id',$id)->update(
                [
                    'nama' => $request->nama,
                    'kode' => $request->kode,
                    'id_kategori' => $request->id_kategori,
                    'harga' => $request->harga,
                    'stok' => $request->stok,
                    'image' => $fileName,
                    'updated_at' => now(),
              ]);
            
            return redirect('/produk')
            ->with('success','Data Berhasil Diubah');
    }

    public function tambah($id)
    {
        $produk = Produk::find($id);
        $rel_kategori = Kategori::orderBy('id', 'DESC')->get();
        return view('admin.produk.tambah_produk', compact('produk', 'rel_kategori'));
    }

    public function tambahDanUpdateProduk(Request $request)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|max:45',
        'kode' => 'required',
        'id_kategori' => 'required',
        'harga' => 'required',
        'stok' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg',
    ]);

    // Proses upload gambar jika ada
    if (!empty($request->image)) {
        $fileName = $request->nama . '.' . $request->image->extension();
        $request->image->move(public_path('admin/assets/image'), $fileName);
    } else {
        $fileName = '';
    }

    // Insert data ke tabel 'restok'
    DB::table('restok')->insert([
        'nama' => $request->nama,
        'kode' => $request->kode,
        'id_kategori' => $request->id_kategori,
        'harga' => $request->harga,
        'stok' => $request->stok,
        'image' => $fileName,
        'created_at' => now(),
    ]);

    // Periksa apakah produk dengan kode tersebut sudah ada di tabel 'produks'
    $produk = DB::table('produks')->where('kode', $request->kode)->first();

    if ($produk) {
        // Jika produk sudah ada, tambahkan stoknya dengan stok dari restok
        $newStok = $produk->stok + $request->stok;

        DB::table('produks')->where('kode', $request->kode)->update([
            'nama' => $request->nama,
            'id_kategori' => $request->id_kategori,
            
            'stok' => $newStok,
            'image' => $fileName ? $fileName : $produk->image,
            'updated_at' => now(),
        ]);
    } else {
        // Jika produk belum ada, tambahkan produk baru
        DB::table('produks')->insert([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'id_kategori' => $request->id_kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'image' => $fileName,
            'created_at' => now(),
        ]);
    }

    return redirect('/produk')->with('success', 'Data Berhasil Ditambahkan dan Stok Diupdate');
}

    
    

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect('produk')->with('success', 'Berhasil Menghapus Kategori');
    }
}
