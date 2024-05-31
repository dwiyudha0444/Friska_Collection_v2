<?php

use Illuminate\Support\Facades\Route;

//auth
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;

//home
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\home\KeranjangController;
use App\Http\Controllers\home\CheckoutController;

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
Route::get('/form_produk', [ProdukController::class, 'create'])->name('create_produk');
Route::post('/form_produk', [ProdukController::class, 'store'])->name('store_produk');
Route::get('/form_produk_edit/{id}', [ProdukController::class, 'edit'])->name('edit_produk');
Route::put('produk/update/{id}', [ProdukController::class, 'update'])->name('update_produk');
Route::delete('/delete_produk/{id}', [ProdukController::class, 'destroy'])->name('destroy_produk');


//kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
Route::get('/form_kategori', [KategoriController::class, 'create'])->name('create_kategori');
Route::post('/form_kategori', [KategoriController::class, 'store'])->name('store_kategori');
Route::get('/form_kategori_edit/{id}', [KategoriController::class, 'edit'])->name('edit_kategori');
Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('update_kategori');
Route::delete('/destroy_kategori/{id}', [KategoriController::class, 'destroy'])->name('destroy_kategori');

//checkout
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

//prediksi
Route::get('/prediksi', [PrediksiController::class, 'index'])->name('prdiksi');

Route::get('/testmv', [PrediksiController::class, 'test'])->name('testmv');


//user
Route::get('/user', [UserController::class, 'index'])->name('user');