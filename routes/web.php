<?php

use Illuminate\Support\Facades\Route;

//auth
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;

//home
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\home\CartController;

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

//admin
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


//produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk');

//prediksi
Route::get('/prediksi', [PrediksiController::class, 'index'])->name('prdiksi');

//kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');

Route::get('/form_kategori', [KategoriController::class, 'create'])->name('create_kategori');
Route::post('/form_kategori', [KategoriController::class, 'store'])->name('store_kategori');

//user
Route::get('/user', [UserController::class, 'index'])->name('user');