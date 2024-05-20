<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fashion;

class HomeController extends Controller
{
    public function index()
    {
        
        return view('home.home');
    }
}