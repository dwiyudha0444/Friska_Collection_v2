<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Prediksi;
use App\Models\Periode;
use App\Models\FilterPenjualanPerbulan;
use App\Helpers\MovingAveragePeriodeTiga;
use App\Helpers\MovingAverage;
use App\Helpers\mad;
use App\Helpers\mse;
use App\Helpers\mape;
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

    // public function tambahPrediksi()
    // {
    //     // Definisikan periode yang ingin digunakan untuk menghitung moving average
    //     $periodes = [3, 6, 12]; // contoh periode: 3 bulan, 6 bulan, 12 bulan
    
    //     // Ambil semua produk terbaru
    //     $produkTerbaru = DB::table('filter_penjualan_perbulan')
    //         ->select('id_produk')
    //         ->distinct()
    //         ->get();
    
    //     // Pastikan ada produk yang terbaru
    //     if ($produkTerbaru->isNotEmpty()) {
    //         foreach ($produkTerbaru as $produk) {
    //             // Ambil data penjualan terbaru untuk produk tertentu
    //             $dataTerbaru = DB::table('filter_penjualan_perbulan')
    //                 ->where('id_produk', $produk->id_produk)
    //                 ->orderBy('created_at', 'desc')
    //                 ->first();
    
    //             foreach ($periodes as $periode) {
    //                 // Hitung Moving Average (MA) menggunakan helper untuk setiap periode
    //                 $ma = MovingAverageHelper::calculateMovingAverage($produk->id_produk, $periode);
    
    //                 // Cek apakah sudah ada data untuk bulan yang sama dan periode yang sama dalam prediksi
    //                 $existingData = Prediksi::where('id_produk', $dataTerbaru->id_produk)
    //                     ->whereYear('created_at', Carbon::now()->year)
    //                     ->whereMonth('created_at', Carbon::now()->month)
    //                     ->where('id_periode', $periode)
    //                     ->first();
    
    //                 // Jika ada data yang sama untuk bulan yang sama dan periode yang sama, perbarui data tersebut
    //                 if ($existingData) {
    //                     $existingData->update([
    //                         'nama' => $dataTerbaru->nama,
    //                         'id_kategori' => $dataTerbaru->id_kategori,
    //                         'ma' => $ma,
    //                     ]);
    //                 } else {
    //                     // Jika tidak ada data yang sama, tambahkan data baru
    //                     Prediksi::create([
    //                         'id_produk' => $dataTerbaru->id_produk,
    //                         'nama' => $dataTerbaru->nama,
    //                         'id_kategori' => $dataTerbaru->id_kategori,
    //                         'id_periode' => $periode,
    //                         'ma' => $ma,
    //                     ]);
    //                 }
    //             }
    //         }
    
    //         return redirect()->route('all-prediksi')->with('success', 'Data prediksi berhasil ditambahkan atau diperbarui.');
    //     } else {
    //         return redirect()->route('all-prediksi')->with('error', 'Tidak ada data terbaru yang ditemukan.');
    //     }
    // }
    
    public function tambahPrediksi2()
    {
        // Mengambil semua produk
        $products = Produk::all();
        $filters = FilterPenjualanPerbulan::all();
    
        $isUpdatedOrCreated = false;
    

    
        foreach ($products as $product) {
            // Cek apakah ada entri dengan id_produk yang sama dalam prediksi untuk MA pertama
            $prediksi1 = Prediksi::where('id_produk', $product->id)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->where('id_periode', 3) // Periode 3 untuk MA pertama
                ->first();
                
            // Cek apakah ada entri dengan id_produk yang sama dalam prediksi untuk MA kedua
            $prediksi2 = Prediksi::where('id_produk', $product->id)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->where('id_periode', 4) // Periode 4 untuk MA kedua
                ->first();
    
            // Hitung Moving Average
            $ma = MovingAverage::calculateMovingAveragePeriodeTiga($product->id);
            $ma2 = MovingAverage::calculateMovingAverage($product->id);
            
            // Hitung MAD
            $mad = mad::calculateMAD($product->id);
            $mad2 = mad::calculateMADPeriodeEmpat($product->id);
            
            // Hitung MSE
            $mse = mse::calculateMSE($product->id);
            $mse2 = mse::calculateMSEPeriodeEmpat($product->id);
            
            // Hitung MAPE
            $mape = mape::calculateMAPE($product->id);
            $mape2 = mape::calculateMAPEPeriodeEmpat($product->id);
            
            if ($prediksi1) {
                // Jika sudah ada, update dengan data yang baru untuk MA pertama
                $prediksi1->update([
                    'id_produk' => $product->id,
                    'nama' => $product->nama,
                    'id_kategori' => $product->id_kategori,
                    'id_periode' => 3,
                    'ma' => $ma,
                    'mad' => $mad,
                    'mse' => $mse,
                    'mape' => $mape,
                ]);
                $isUpdatedOrCreated = true;
            } else {
                // Jika belum ada, buat entri baru untuk MA pertama
                Prediksi::create([
                    'id_produk' => $product->id,
                    'nama' => $product->nama,
                    'id_kategori' => $product->id_kategori,
                    'id_periode' => 3,
                    'ma' => $ma,
                    'mad' => $mad,
                    'mse' => $mse,
                    'mape' => $mape,
                ]);
                $isUpdatedOrCreated = true;
            }
    
            if ($prediksi2) {
                // Jika sudah ada, update dengan data yang baru untuk MA kedua
                $prediksi2->update([
                    'id_produk' => $product->id,
                    'nama' => $product->nama,
                    'id_kategori' => $product->id_kategori,
                    'id_periode' => 4,
                    'ma' => $ma2,
                    'mad' => $mad2,
                    'mse' => $mse2,
                    'mape' => $mape2,
                ]);
                $isUpdatedOrCreated = true;
            } else {
                // Jika belum ada, buat entri baru untuk MA kedua
                Prediksi::create([
                    'id_produk' => $product->id,
                    'nama' => $product->nama,
                    'id_kategori' => $product->id_kategori,
                    'id_periode' => 4,
                    'ma' => $ma2,
                    'mad' => $mad2,
                    'mse' => $mse2,
                    'mape' => $mape2,
                ]);
                $isUpdatedOrCreated = true;
            }
        }
    
        if ($isUpdatedOrCreated) {
            return redirect()->route('all-prediksi')->with('success', 'Data prediksi berhasil ditambahkan atau diperbarui.');
        } else {
            return redirect()->route('all-prediksi')->with('error', 'Tidak ada data terbaru yang ditemukan.');
        }
    }
    

    



    public function tambahPrediksi()
    {
        // Ambil periode terbaru
        $periode = Periode::latest()->first();
    
        // Pastikan ada periode yang ditemukan sebelum melanjutkan
        if (!$periode) {
            return redirect()->route('all-prediksi')->with('error', 'Periode tidak ditemukan.');
        }
    
        // Ambil semua produk terbaru
        $produkTerbaru = DB::table('filter_penjualan_perbulan')
            ->select('id_produk')
            ->distinct()
            ->get();
    
        // Pastikan ada produk terbaru
        if ($produkTerbaru->isNotEmpty()) {
            foreach ($produkTerbaru as $produk) {
                // Ambil data penjualan terbaru untuk produk tertentu
                $dataTerbaru = DB::table('filter_penjualan_perbulan')
                    ->where('id_produk', $produk->id_produk)
                    ->orderBy('created_at', 'desc')
                    ->first();
    
                // Hitung Moving Average (MA) menggunakan helper untuk data asli
                $ma = MovingAverage::calculateMovingAveragePeriodeTiga($produk->id_produk);
    
                // Hitung Moving Average (MA) kedua untuk data yang berbeda
                $ma2 = MovingAverage::calculateMovingAverage($produk->id_produk);
    
                $mad = mad::calculateMAD($produk->id_produk);

                // Cek apakah sudah ada data untuk id_produk dan periode 3
                $existingDataPeriode3 = Prediksi::where('id_produk', $dataTerbaru->id_produk)
                    ->where('id_periode', 3)
                    ->exists();
    
                // Jika belum ada, tambahkan data baru untuk periode 3
                if (!$existingDataPeriode3) {
                    Prediksi::create([
                        'id_produk' => $dataTerbaru->id_produk,
                        'nama' => $dataTerbaru->nama,
                        'id_kategori' => $dataTerbaru->id_kategori,
                        'id_periode' => 3,
                        'ma' => $ma,
                        'mad' => $mad,
                    ]);
                }
    
                // Cek apakah sudah ada data untuk id_produk dan periode 4
                $existingDataPeriode4 = Prediksi::where('id_produk', $dataTerbaru->id_produk)
                    ->where('id_periode', 4)
                    ->exists();
    
                // Jika belum ada, tambahkan data baru untuk periode 4
                if (!$existingDataPeriode4) {
                    Prediksi::create([
                        'id_produk' => $dataTerbaru->id_produk,
                        'nama' => $dataTerbaru->nama,
                        'id_kategori' => $dataTerbaru->id_kategori,
                        'id_periode' => 4,
                        'ma' => $ma2,
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
        $selectedData = Prediksi::whereIn('id_produk', $selectedProductIds)
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil data berdasarkan id_produk yang dipilih
        $selectedDataFirst = Prediksi::whereIn('id_produk', $selectedProductIds)
            ->selectRaw('MAX(id) as id') // Memilih id terbaru untuk setiap id_produk
            ->groupBy('id_produk')
            ->get();

        // Ambil data lengkap berdasarkan id terbaru yang dipilih
        $selectedDataAll = Prediksi::whereIn('id', $selectedDataFirst->pluck('id'))
        ->orderBy('created_at', 'desc')
        ->get();
        
        // Siapkan array kosong untuk menyimpan nilai MAD
        $madValues = [];
        $madValuesPeriodeEmpat = [];
        // Siapkan array kosong untuk menyimpan nilai MSE
        $mseValues = [];
        $mseValuesPeriodeEmpat = [];
    
        // Ambil nilai MAD dari helpermad untuk setiap produk yang dipilih
        foreach ($selectedProductIds as $id_produk) {
            $madValue = mad::calculateTotalMad($id_produk); 
            $madValues[$id_produk] = $madValue;
        }
        // Periode 4
        foreach ($selectedProductIds as $id_produk) {
            $madValuePeriodeEmpat = mad::calculateTotalMadPeriodeEmpat($id_produk); 
            $madValuesPeriodeEmpat[$id_produk] = $madValuePeriodeEmpat;
        }
        // Ambil nilai MSE dari helpermad untuk setiap produk yang dipilih
        foreach ($selectedProductIds as $id_produk) {
            $mseValue = mse::calculateTotalMse($id_produk); 
            $mseValues[$id_produk] = $mseValue;
        }
        // Periode 4
        foreach ($selectedProductIds as $id_produk) {
            $mseValuePeriodeEmpat = mse::calculateTotalMSEPeriodeEmpat($id_produk); 
            $mseValuesPeriodeEmpat[$id_produk] = $mseValuePeriodeEmpat;
        }
        // Ambil nilai MAPE dari helpermad untuk setiap produk yang dipilih
        foreach ($selectedProductIds as $id_produk) {
            $mapeValue = mape::calculateTotalMAPE($id_produk); 
            $mapeValues[$id_produk] = $mapeValue;
        }
        // Periode 4
        foreach ($selectedProductIds as $id_produk) {
            $mapeValuePeriodeEmpat = mape::calculateTotalMAPEPeriodeEmpat($id_produk); 
            $mapeValuesPeriodeEmpat[$id_produk] = $mapeValuePeriodeEmpat;
        }
    
        // Misalnya, tampilkan data tersebut
        return view('admin.prediksi.selected-prediksi', [
            'selectedData' => $selectedData, //menampilkan selurug data berdasarkan data yang dipilih
            'selectedDataFirst' => $selectedDataAll, //Menampilkan pertama berdasarkan id yang dipilih
            'madValues' => $madValues, // Menampilkan Nilai Total MAD
            'madValuesPeriodeEmpat' => $madValuesPeriodeEmpat,
            'mseValues' => $mseValues, // Menampilkan Nilai Total MSE
            'mseValuesPeriodeEmpat' => $mseValuesPeriodeEmpat,
            'mapeValues' => $mapeValues, // Menampilkan Nilai Total MAPE
            'mapeValuesPeriodeEmpat' => $mapeValuesPeriodeEmpat,
        ]);
    }
    
    

    
}
