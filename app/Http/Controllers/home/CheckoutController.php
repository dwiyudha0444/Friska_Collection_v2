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
    // public function checkout(Request $request)
    // {
    //     // Validasi data form
    //     $request->validate([
    //         'id_produk' => 'required|array',
    //         'id_produk.*' => 'required|integer',
    //         'nama' => 'required|array',
    //         'nama.*' => 'required|string|max:255',
    //         'id_kategori' => 'required|array',
    //         'id_kategori.*' => 'required|integer',
    //         'image' => 'required|array',
    //         'image.*' => 'required|string',
    //         'harga' => 'required|array',
    //         'harga.*' => 'required|numeric',
    //         'qty' => 'required|array',
    //         'qty.*' => 'required|integer|min:1',
    //     ]);

    //     // Mulai transaksi
    //     DB::beginTransaction();

    //     try {
    //         $count = count($request->id_produk);

    //         for ($i = 0; $i < $count; $i++) {
    //             // Ambil produk berdasarkan id_produk
    //             $produk = Produk::findOrFail($request->id_produk[$i]);
    //             Log::info('Produk ditemukan: ', ['produk' => $produk]);

    //             // Kurangi stok produk dengan qty dari item
    //             if ($produk->stok < $request->qty[$i]) {
    //                 return redirect('/keranjang')->with('error', 'Stok tidak mencukupi untuk produk: ' . $request->nama[$i]);
    //             }

    //             $produk->stok -= $request->qty[$i];
    //             $produk->save();
    //             Log::info('Stok produk dikurangi: ', ['stok' => $produk->stok]);

    //             // Simpan data ke dalam database Penjualan
    //             Penjualan::create([
    //                 'id_produk' => $request->id_produk[$i],
    //                 'nama' => $request->nama[$i],
    //                 'id_kategori' => $request->id_kategori[$i],
    //                 'image' => $request->image[$i],
    //                 'harga' => $request->harga[$i],
    //                 'qty' => $request->qty[$i],
    //             ]);
    //             Log::info('Data penjualan disimpan');
    //         }

    //         // Hapus semua data dari keranjang (cart)
    //         Keranjang::truncate(); //

    //         // Commit transaksi
    //         DB::commit();
    //         Log::info('Transaksi berhasil');

    //         // Response sukses
    //         return redirect('/keranjang')->with('success', 'Berhasil Checkout');

        
    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollback();
    //         Log::error('Terjadi kesalahan saat checkout: ', ['error' => $e->getMessage()]);

    //         return redirect('/keranjang')->with('error', 'Terjadi kesalahan saat checkout');
    //     }
    // }


    public function checkout2(Request $request) {
        try {
            // Dapatkan semua produk dari basis data
            $allProducts = Produk::all();
    
            foreach ($allProducts as $product) {
                // Cari item di keranjang yang sesuai dengan produk saat ini
                $itemInCart = collect($request->items)->firstWhere('id_produk', $product->id);
    
                // Cek apakah ada entri dengan id_produk yang sama dalam filter_penjualan_bulanan
                $filterPenjualan = FilterPenjualanPerbulan::where('id_produk', $product->id)
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->first();
    
                if ($filterPenjualan) {
                    // Jika sudah ada, tambahkan qty baru ke qty yang sudah ada
                    $filterPenjualan->qty += $itemInCart ? $itemInCart['qty'] : 0;
                    $filterPenjualan->save();
                } else {
                    // Jika belum ada, buat entri baru
                    FilterPenjualanPerbulan::create([
                        'id_produk' => $product->id,
                        'nama' => $product->nama,
                        'id_kategori' => $product->id_kategori,
                        'image' => $product->image,
                        'harga' => $product->harga,
                        'qty' => $itemInCart ? $itemInCart['qty'] : 0,
                    ]);
                }
    
                if ($itemInCart) {
                    // Simpan data ke dalam database penjualan hanya jika item ada di keranjang
                    Penjualan::create([
                        'id_produk' => $itemInCart['id_produk'],
                        'nama' => $itemInCart['nama'],
                        'id_kategori' => $itemInCart['id_kategori'],
                        'image' => $itemInCart['image'],
                        'harga' => $itemInCart['harga'],
                        'qty' => $itemInCart['qty'],
                    ]);
    
                    // Kurangi stok produk
                    $produk = Produk::findOrFail($itemInCart['id_produk']);
                    $produk->stok -= $itemInCart['qty'];
                    $produk->save();
                }
            }
    
            // Hapus semua data dari keranjang
            Keranjang::truncate(); // Jika menggunakan Eloquent, asumsikan model Keranjang Anda adalah Keranjang
    
            // Response sukses
            return redirect('/keranjang')->with('success', 'Berhasil Melakukan Transaksi');
        } catch (\Exception $e) {
            // Tangani jika terjadi error dalam menyimpan data atau menghapus data dari keranjang
            return redirect('/keranjang')->with('error', 'Terjadi kesalahan saat melakukan checkout');
        }
    }
    
    
    

}
