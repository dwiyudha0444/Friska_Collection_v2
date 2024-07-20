<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Crud;
use DB;

class CrudController extends Controller
{
    public function index()
    {
        $crud = Crud::orderBy('id','DESC')->get();
        return view('admin.prediksi.test.index',compact('crud'));
    }
}
