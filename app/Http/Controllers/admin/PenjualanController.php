<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\FilterPenjualanPerbulan;
use DB;

class PenjualanController extends Controller
{
    public function indexPeper()
    {
        $penjualan_perbulan = FilterPenjualanPerbulan::orderBy('id','DESC')->get();
        return view('admin.penjualan.penjualan_perbulan.index',compact('penjualan_perbulan'));
    }
}
