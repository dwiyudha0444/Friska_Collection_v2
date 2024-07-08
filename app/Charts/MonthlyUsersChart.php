<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\FilterPenjualanPerbulan;
use App\Models\Prediksi;
use Carbon\Carbon;
use DB;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // Ambil data penjualan fisik dari database
        $data = Prediksi::orderBy('created_at', 'asc')->get();


        // Inisialisasi data untuk penjualan fisik
        $physicalSales = [];
        $physicalSalesMa = [];
        $months = [];

;
    
        // Loop untuk memproses data penjualan fisik
        foreach ($data as $item) {
            $month = date('F', strtotime($item->created_at)); // Ambil nama bulan dari tanggal
            $qty = $item->qty;
            $ma = round($item->ma);

            // Jika bulan belum ada dalam array $months
            if (!in_array($month, $months)) {
                $months[] = $month; // Tambahkan nama bulan ke array $months
                $physicalSales[] = $qty; // Tambahkan qty ke array $physicalSales
                $physicalSalesMa[] = $ma; 
            } else {
                // Jika bulan sudah ada, tambahkan qty ke data penjualan fisik
                $physicalSales[array_search($month, $months)] += $qty;
                $physicalSalesMa[array_search($month, $months)] += $ma;
            }
        }


        // Buat objek chart menggunakan LarapexCharts
        return $this->chart->lineChart()
            ->setTitle('Sales during 2021.')
            ->setSubtitle('Physical sales vs Predicted sales.')
            // ->addData('Physical sales', $physicalSales)
            ->addData('Predicted sales', $physicalSalesMa)
            ->setXAxis($months); // Set label bulan ke sumbu X
    }
}
