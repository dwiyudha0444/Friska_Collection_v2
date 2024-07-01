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
use App\Http\Controllers\admin\PenjualanController;



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
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('checkAuth');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register-proses', [RegisterController::class, 'register_proses'])->name('register-proses');

//home
Route::get('/landingpage', [HomeController::class, 'index'])->name('landingpage');

// halaman tunggu
Route::get('/waiting', function () {
    return view('waiting');
});

// Route untuk halaman larangan
Route::get('/forbidden', function () {
    return view('forbidden');
})->name('forbidden');

//keranjang
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang')->middleware('check.status');
Route::post('/add-to-keranjang', [KeranjangController::class, 'store'])->name('add-to-keranjang');
Route::post('/hapus-item', [KeranjangController::class, 'hapusItem'])->name('hapus-item');
Route::post('/update-keranjang', [KeranjangController::class, 'updateKeranjang'])->name('update-keranjang');


Route::middleware(['auth', 'checkAdminPemilik'])->group(function () {

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

    //penjualan
    Route::get('/penjualan-perbulan', [PenjualanController::class, 'indexPeper'])->name('penjualan-perbulan');
    Route::get('/penjualan-peritem', [PenjualanController::class, 'indexPetim'])->name('penjualan-peritem');

    //prediksi
    Route::get('/prediksi', [PrediksiController::class, 'index'])->name('prdiksi');
    Route::get('/all-prediksi', [PrediksiController::class, 'create'])->name('all-prediksi');
    Route::get('/tambah-prediksi', [PrediksiController::class, 'tambahPrediksi2'])->name('tambah-prediksi');
    Route::post('/pilih-produk', [PrediksiController::class, 'pilihProduk'])->name('pilih-produk');
    Route::get('/testmv', [PrediksiController::class, 'test'])->name('testmv');

    //user
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::delete('/destroy_user/{id}', [UserController::class, 'destroy'])->name('destroy_user');
    Route::get('/form_user_edit/{id}', [UserController::class, 'edit'])->name('edit_user');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('update_user');
    
});

//checkout
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
//checkout
Route::post('/checkout2', [CheckoutController::class, 'checkout2'])->name('checkout2');
