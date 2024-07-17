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
use App\Helpers\DataPenjualan;
use Carbon\Carbon;
use DB;

class HitungPrediksiController extends Controller
{
    public function index()
    {
        return view('admin.prediksi.hitung.index');
    }

    public function indexBulanSebelumnya()
    {
        // $produkList = Produk::pluck('nama', 'id')->toArray(); 
        // return view('admin.prediksi.hitung.BulanDepan.index', compact('produkList'));

               // Ambil data prediksi terbaru berdasarkan id_produk
               $prediksi = Prediksi::select('id_produk', \DB::raw('MAX(id) as id'))
               ->groupBy('id_produk')
               ->orderBy('id', 'DESC')
               ->get();
       
           $prediksi = Prediksi::whereIn('id', $prediksi->pluck('id'))->get();
       
           // Ambil semua periode
           $periode = Periode::all(); // Gantilah 'Periode' dengan model yang sesuai jika berbeda
       
           // Kirim data prediksi dan periode ke view
           return view('admin.prediksi.hitung.BulanSebelumnya.index', compact('prediksi', 'periode'));
    }

    public function indexBulanDepan()
    {
        // $produkList = Produk::pluck('nama', 'id')->toArray(); 
        // return view('admin.prediksi.hitung.BulanDepan.index', compact('produkList'));

               // Ambil data prediksi terbaru berdasarkan id_produk
               $prediksi = Prediksi::select('id_produk', \DB::raw('MAX(id) as id'))
               ->groupBy('id_produk')
               ->orderBy('id', 'DESC')
               ->get();
       
           $prediksi = Prediksi::whereIn('id', $prediksi->pluck('id'))->get();
       
           // Ambil semua periode
           $periode = Periode::all(); // Gantilah 'Periode' dengan model yang sesuai jika berbeda
       
           // Kirim data prediksi dan periode ke view
           return view('admin.prediksi.hitung.BulanDepan.index', compact('prediksi', 'periode'));
    }

    public function indexHasilSb(Request $request)
    {
        $selectedIds = $request->input('selected_ids');
        $idPeriode = $request->input('id_periode'); // Ambil id_periode dari request
    
        // Buat array kosong untuk menyimpan id_produk yang dipilih
        $selectedProductIds = [];
    
        // Ambil id_produk dari data yang dipilih
        foreach ($selectedIds as $id) {
            $prediksi = Prediksi::find($id);
            if ($prediksi) {
                $selectedProductIds[] = $prediksi->id_produk;
            }
        }
    
        // Ambil data berdasarkan id_produk yang dipilih dan id_periode, kemudian kelompokkan
        $selectedData = Prediksi::whereIn('id_produk', $selectedProductIds)
            ->where('id_periode', $idPeriode) // Tambahkan filter id_periode
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('id_produk'); // Kelompokkan berdasarkan id_produk
    
        // Tampilkan data tersebut
        return view('admin.prediksi.hitung.BulanSebelumnya.hasil', [
            'groupedData' => $selectedData, // Kirim data yang sudah dikelompokkan ke view
        ]);
        
    }

    public function indexHasil(Request $request)
    {
        $selectedIds = $request->input('selected_ids');
        $idPeriode = $request->input('id_periode'); // Ambil id_periode dari request
    
        // Buat array kosong untuk menyimpan id_produk yang dipilih
        $selectedProductIds = [];
    
        // Ambil id_produk dari data yang dipilih
        foreach ($selectedIds as $id) {
            $prediksi = Prediksi::find($id);
            if ($prediksi) {
                $selectedProductIds[] = $prediksi->id_produk;
            }
        }
    
        // Ambil data berdasarkan id_produk yang dipilih dan id_periode, kemudian kelompokkan
        $selectedData = Prediksi::whereIn('id_produk', $selectedProductIds)
            ->where('id_periode', $idPeriode) // Tambahkan filter id_periode
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('id_produk'); // Kelompokkan berdasarkan id_produk
    
        // Tampilkan data tersebut
        return view('admin.prediksi.hitung.BulanDepan.hasil', [
            'groupedData' => $selectedData, // Kirim data yang sudah dikelompokkan ke view
        ]);
        
    }

}
