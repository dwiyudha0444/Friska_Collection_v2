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

    public function edit()
    {
        $users = User::orderBy('id','DESC')->get();
        return view('admin.user.form_edit',compact('users'));
    }

    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect('user')->with('success', 'Berhasil Menghapus User');
    }

}