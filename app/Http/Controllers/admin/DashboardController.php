<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Charts\MonthlyUsersChart;

class DashboardController extends Controller
{
    public function index(MonthlyUsersChart $chart)
    {
        return view('admin.dashboard.index', ['chart' => $chart->build()]);
    } 
}
