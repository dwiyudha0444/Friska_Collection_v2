<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;

class KeranjangController extends Controller
{
    public function index()
    {
        // Ambil data dari model Keranjang
        $keranjang = Keranjang::orderBy('id', 'DESC')->get();

        // Ambil data dari model Produk
        $produk = Produk::orderBy('id', 'ASC')->get();

        // Kembalikan view dengan data gabungan menggunakan compact
        return view('home.keranjang.index', compact('keranjang','produk'));
    }

    public function store(Request $request)
    {
        // Validasi data form
        $request->validate([
            'id_produk' => 'required',
            'nama' => 'required|string|max:255',
            'id_kategori' => 'required',
            'image' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'qty' => 'required',
        ]);

        // Simpan data ke dalam database Kategori
        Keranjang::create([
            'id_produk' => $request->id_produk,
            'nama' => $request->nama,
            'id_kategori' => $request->id_kategori,
            'image' => $request->image,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'qty' => $request->qty,
        ]);

        // Response sukses
        return redirect('/keranjang')->with('success', 'Berhasil Menambahkan Ke Keranjang');
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

    public function updateKeranjang(Request $request)
    {
        try {
            $cartId = $request->input('cart_id');
            $quantity = $request->input('quantity');

            // Validasi input
            if (empty($cartId) || empty($quantity)) {
                return response()->json(['message' => 'Data tidak valid'], 400);
            }

            // Temukan item keranjang berdasarkan ID dan perbarui jumlah
            $cartItem = Keranjang::find($cartId);
            if (!$cartItem) {
                return response()->json(['message' => 'Item keranjang tidak ditemukan'], 404);
            }

            $cartItem->qty = $quantity;
            $cartItem->save();

            return response()->json(['message' => 'Keranjang berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            Log::error('Error updating cart: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan saat memperbarui keranjang'], 500);
        }
    }
}
