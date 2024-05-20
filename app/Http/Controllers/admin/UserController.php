<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $loggedInUserId = auth()->user()->id;

        // Mendapatkan daftar pengguna yang bukan pengguna yang sedang login
        $users = User::where('id', '!=', $loggedInUserId)
                    ->orderBy('id', 'DESC')
                    ->get();

        return view('admin.user.index', compact('users'));
    }

}