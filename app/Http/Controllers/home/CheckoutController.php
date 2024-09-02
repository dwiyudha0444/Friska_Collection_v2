<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\FilterPenjualanPerbulan;
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
                $produk = Produk::findOrFail($request->id_produk[$i]);
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

            // Hapus semua data dari keranjang (cart)
            Keranjang::truncate(); //

            // Commit transaksi
            DB::commit();
            Log::info('Transaksi berhasil');

            // Response sukses
            return redirect('/keranjang')->with('success', 'Berhasil Checkout');

        
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();
            Log::error('Terjadi kesalahan saat checkout: ', ['error' => $e->getMessage()]);

            return redirect('/keranjang')->with('error', 'Terjadi kesalahan saat checkout');
        }
    }


    public function checkout2(Request $request) {
        try {
            foreach ($request->items as $item) {
                // Cek apakah ada entri dengan id_produk yang sama dalam filter_penjualan_bulanan
                $filterPenjualan = FilterPenjualanPerbulan::where('id_produk', $item['id_produk'])
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->first();
    
                if ($filterPenjualan) {
                    // Jika sudah ada, tambahkan qty baru ke qty yang sudah ada
                    $filterPenjualan->qty += $item['qty'];
                    $filterPenjualan->save();
                } else {
                    // Jika belum ada, buat entri baru
                    FilterPenjualanPerbulan::create([
                        'id_produk' => $item['id_produk'],
                        'nama' => $item['nama'],
                        'id_kategori' => $item['id_kategori'], 
                        'image' => $item['image'],
                        'harga' => $item['harga'],
                        'qty' => $item['qty'],
                    ]);
                }
    
                // Simpan data ke dalam database filter
                Penjualan::create([
                    'id_produk' => $item['id_produk'],
                    'nama' => $item['nama'],
                    'id_kategori' => $item['id_kategori'], 
                    'image' => $item['image'],
                    'harga' => $item['harga'],
                    'qty' => $item['qty'],
                ]);
    
                // Kurangi stok produk
                $produk = Produk::findOrFail($item['id_produk']); 
                $produk->stok -= $item['qty'];
                $produk->save();
            }
            
            // Hapus semua data dari keranjang (cart)
            Keranjang::truncate(); // Jika menggunakan Eloquent, asumsikan model Cart Anda adalah Cart
    
            // Response sukses
            return redirect('/keranjang')->with('success', 'Berhasil Melakukan Transaksi');
        } catch (\Exception $e) {
            // Tangani jika terjadi error dalam menyimpan data atau menghapus data dari keranjang
            return redirect('/keranjang')->with('error', 'Terjadi kesalahan saat melakukan checkout');
        }
    }
    
    

}
