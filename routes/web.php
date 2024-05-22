<?php

use Illuminate\Support\Facades\Route;

//auth
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;

//home
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\home\KeranjangController;

//admin
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProdukController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\PrediksiController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



//auth
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register-proses', [RegisterController::class, 'register_proses'])->name('register-proses');

//home
Route::get('/landingpage', [HomeController::class, 'index'])->name('landingpage');

//keranjang
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang');
Route::post('/add-to-keranjang', [KeranjangController::class, 'store'])->name('add-to-keranjang');
Route::post('/hapus-item', [KeranjangController::class, 'hapusItem'])->name('hapus-item');
Route::post('/update-keranjang', [KeranjangController::class, 'update'])->name('update-keranjang');


//admin
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


//produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
//add
Route::get('/form_produk', [ProdukController::class, 'create'])->name('create_produk');
Route::post('/form_produk', [ProdukController::class, 'store'])->name('store_produk');

//prediksi
Route::get('/prediksi', [PrediksiController::class, 'index'])->name('prdiksi');

//kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
//add
Route::get('/form_kategori', [KategoriController::class, 'create'])->name('create_kategori');
Route::post('/form_kategori', [KategoriController::class, 'store'])->name('store_kategori');
//update
Route::get('/form_kategori_edit/{id}', [KategoriController::class, 'edit'])->name('edit_kategori');
Route::post('/form_kategori_edit', [KategoriController::class, 'update'])->name('update_kategori');
Route::put('kategori/{kategori}', [KategoriController::class, 'update'])->name('update_kategori');
//delete
Route::delete('/destroy_kategori/{id}', [KategoriController::class, 'destroy'])->name('destroy_kategori');

//user
Route::get('/user', [UserController::class, 'index'])->name('user');