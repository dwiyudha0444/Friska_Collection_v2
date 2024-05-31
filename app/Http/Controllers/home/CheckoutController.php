<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Penjualan;
use App\Models\produk;
use DB;
use Log;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // Validasi data form
        $request->validate([
            'id_produk' => 'required|array',
            'id_produk.*' => 'required|integer',
            'nama' => 'required|array',
            'nama.*' => 'required|string|max:255',
            'id_kategori' => 'required|array',
            'id_kategori.*' => 'required|integer',
            'image' => 'required|array',
            'image.*' => 'required|string',
            'harga' => 'required|array',
            'harga.*' => 'required|numeric',
            'qty' => 'required|array',
            'qty.*' => 'required|integer|min:1',
        ]);

        // Mulai transaksi
        DB::beginTransaction();

        try {
            $count = count($request->id_produk);

            for ($i = 0; $i < $count; $i++) {
                // Ambil produk berdasarkan id_produk
                $produk = produk::findOrFail($request->id_produk[$i]);
                Log::info('Produk ditemukan: ', ['produk' => $produk]);

                // Kurangi stok produk dengan qty dari item
                if ($produk->stok < $request->qty[$i]) {
                    return redirect('/keranjang')->with('error', 'Stok tidak mencukupi untuk produk: ' . $request->nama[$i]);
                }

                $produk->stok -= $request->qty[$i];
                $produk->save();
                Log::info('Stok produk dikurangi: ', ['stok' => $produk->stok]);

                // Simpan data ke dalam database Penjualan
                Penjualan::create([
                    'id_produk' => $request->id_produk[$i],
                    'nama' => $request->nama[$i],
                    'id_kategori' => $request->id_kategori[$i],
                    'image' => $request->image[$i],
                    'harga' => $request->harga[$i],
                    'qty' => $request->qty[$i],
                ]);
                Log::info('Data penjualan disimpan');
            }

            // Commit transaksi
            DB::commit();
            Log::info('Transaksi berhasil');

            // Response sukses
            return redirect('/keranjang')->with('success', 'Berhasil Checkout');

            // Hapus semua data dari keranjang (cart)
            Keranjang::truncate(); //
        
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();
            Log::error('Terjadi kesalahan saat checkout: ', ['error' => $e->getMessage()]);

            return redirect('/keranjang')->with('error', 'Terjadi kesalahan saat checkout');
        }
    }
}
