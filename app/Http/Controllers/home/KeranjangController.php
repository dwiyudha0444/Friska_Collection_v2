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

    public function hapusItem(Request $request) {
        // Temukan item berdasarkan ID
        $item = Keranjang::find($request->cart_id);
    
        // Hapus item jika ditemukan
        if ($item) {
            $item->delete();
            
            return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
        } else {
            
            return redirect()->back()->with('error', 'Item tidak ditemukan dalam keranjang.');
        }
    }

    public function update(Request $request) {
        $cartIds = $request->input('cart_id');
        $quantities = $request->input('quantity');

        // Iterate through each cart item and update its quantity
        foreach ($cartIds as $index => $cartId) {
            $cartItem = Keranjang::find($cartId);
            if ($cartItem) {
                $cartItem->qty = $quantities[$index];
                $cartItem->save();
            }
        }
    
        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Keranjang diperbarui dengan sukses.');
    }
}
