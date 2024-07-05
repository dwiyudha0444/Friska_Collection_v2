<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\FilterPenjualanPerbulan;
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
        // Ambil data dari database berdasarkan bulan untuk tahun 2021
        $data = DB::table('filter_penjualan_perbulan')
            ->whereYear('created_at', 2024) // Ambil data tahun 2021
            ->orderBy('created_at', 'asc') // Urutkan berdasarkan tanggal secara ascending
            ->get();
    
        // Inisialisasi data untuk chart
        $physicalSales = [];
        $months = [];
    
        // Inisialisasi variabel untuk menghitung total qty per bulan
        $monthlyTotals = [];
    
        // Loop untuk memproses data yang diambil dari database
        foreach ($data as $item) {
            $month = date('F', strtotime($item->created_at)); // Ambil nama bulan dari tanggal
            $qty = $item->qty;
    
            // Jika bulan belum ada dalam array $months
            if (!in_array($month, $months)) {
                $months[] = $month; // Tambahkan nama bulan ke array $months
                $physicalSales[] = $qty; // Tambahkan qty ke array $physicalSales
                $monthlyTotals[$month] = $qty; // Simpan qty untuk bulan ini
            } else {
                // Jika bulan sudah ada, tambahkan qty ke total qty bulan ini
                $physicalSales[array_search($month, $months)] += $qty;
                $monthlyTotals[$month] += $qty;
            }
        }
    
        // Buat objek chart menggunakan LarapexCharts
        return $this->chart->lineChart()
            ->setTitle('Sales during 2021.')
            ->setSubtitle('Physical sales vs Digital sales.')
            ->addData('Physical sales', $physicalSales) // Masukkan data qty ke chart
            ->setXAxis($months); // Set label bulan ke sumbu X
    }
    
    
}
