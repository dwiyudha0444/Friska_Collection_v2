<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Prediksi;
use App\Helpers\MovingAverageHelper;
use Carbon\Carbon;
use DB;

class PrediksiController extends Controller
{
    // public function index()
    // {
    //     $prediksi = Prediksi::orderBy('id','DESC')->get();
    //     return view('admin.prediksi.index',compact('prediksi'));
    // }

    public function index()
    {
        $prediksi = Prediksi::select('id_produk', \DB::raw('MAX(id) as id'))
                            ->groupBy('id_produk')
                            ->orderBy('id', 'DESC')
                            ->get();

        $prediksi = Prediksi::whereIn('id', $prediksi->pluck('id'))->get();

        return view('admin.prediksi.index', compact('prediksi'));
    }

    public function test()
    {
        return view('admin.prediksi.test');
    }

    public function create()
    {
        $prediksi = Prediksi::orderBy('id','DESC')->get();
        return view('admin.prediksi.all',compact('prediksi'));
    }

    public function tambahPrediksi()
    {
        // Ambil semua produk terbaru
        $produkTerbaru = DB::table('filter_penjualan_perbulan')
            ->select('id_produk')
            ->distinct()
            ->get();
    
        // Pastikan ada produk yang terbaru
        if ($produkTerbaru->isNotEmpty()) {
            foreach ($produkTerbaru as $produk) {
                // Ambil data penjualan terbaru untuk produk tertentu
                $dataTerbaru = DB::table('filter_penjualan_perbulan')
                    ->where('id_produk', $produk->id_produk)
                    ->orderBy('created_at', 'desc')
                    ->first();
    
                // Cek apakah sudah ada data untuk bulan yang sama dalam prediksi
                $existingData = Prediksi::where('id_produk', $dataTerbaru->id_produk)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->first();
    
                // Hitung Moving Average (MA) menggunakan helper
                $ma = MovingAverageHelper::calculateMovingAverage($produk->id_produk);
    
                // Jika ada data yang sama untuk bulan yang sama, perbarui data tersebut
                if ($existingData) {
                    $existingData->update([
                        'nama' => $dataTerbaru->nama,
                        'id_kategori' => $dataTerbaru->id_kategori,
                        'ma' => $ma,
                    ]);
                } else {
                    // Jika tidak ada data yang sama, tambahkan data baru
                    Prediksi::create([
                        'id_produk' => $dataTerbaru->id_produk,
                        'nama' => $dataTerbaru->nama,
                        'id_kategori' => $dataTerbaru->id_kategori,
                        'ma' => $ma,
                    ]);
                }
            }
    
            return redirect()->route('all-prediksi')->with('success', 'Data prediksi berhasil ditambahkan atau diperbarui.');
        } else {
            return redirect()->route('all-prediksi')->with('error', 'Tidak ada data terbaru yang ditemukan.');
        }
    }
    
    public function pilihProduk(Request $request)
    {
        $selectedIds = $request->input('selected_ids');

        // Buat array kosong untuk menyimpan id_produk yang dipilih
        $selectedProductIds = [];

        // Ambil id_produk dari data yang dipilih
        foreach ($selectedIds as $id) {
            $prediksi = Prediksi::find($id);
            if ($prediksi) {
                $selectedProductIds[] = $prediksi->id_produk;
            }
        }

        // Ambil data berdasarkan id_produk yang dipilih
        $selectedData = Prediksi::whereIn('id_produk', $selectedProductIds)->get();

        // Lakukan sesuatu dengan data yang dipilih
        // Misalnya, tampilkan data tersebut
        return view('admin.prediksi.selected-prediksi', ['selectedData' => $selectedData]);
    }


    
}
