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

    public function create()
    {
        return view('admin.kategori.form');
    }

    public function store(Request $request)
    {
        // Validasi data form
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Simpan data ke dalam database Kategori
        Kategori::create([
            'nama' => $request->nama,
        ]);

        // Response sukses
        return redirect('/kategori')->with('success', 'Berhasil Menambahkan Kategori');
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('admin.kategori.form_edit',compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);

        // Memperbarui data kategori
        $kategori->update($validatedData);

        // Mengarahkan kembali dengan pesan sukses
        return redirect('/kategori')->with('success', 'Kategori berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect('kategori')->with('success', 'Berhasil Menghapus Kategori');
    }

}
