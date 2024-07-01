<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

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

    public function edit($id)
    {
        $users = User::find($id);
        return view('admin.user.form_edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:45',
            'email' => 'required|email',
            'role' => 'required',
            'status' => 'required',
        ]);

        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->route('edit_user', ['id' => $id])
            ->with('success', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect('user')->with('success', 'Berhasil Menghapus User');
    }

}