<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome', [
        'title' => 'Royal Desserts',
    ]);
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/home', [HomeController::class, 'addToCart'])->name('cart.add');
Route::post('/home/cart/update', [HomeController::class, 'updateCart'])->name('cart.update');
Route::post('/home/cart/remove', [HomeController::class, 'removeCart'])->name('cart.remove');
Route::post('/home/cart/clear', [HomeController::class, 'clearAllCart'])->name('cart.clear');

Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('admin/produk', [ProdukController::class, 'index'])->name('admin.produk')->middleware('is_admin');
Route::get('admin/produk/create', [ProdukController::class, 'create'])->name('admin.produk.create')->middleware('is_admin');
Route::post('admin/produk/store', [ProdukController::class, 'store'])->name('admin.produk.store')->middleware('is_admin');
Route::get('admin/produk/edit/{id}', [ProdukController::class, 'edit'])->name('admin.produk.edit')->middleware('is_admin');
Route::post('admin/produk/update/{id}', [ProdukController::class, 'update'])->name('admin.produk.update')->middleware('is_admin');
Route::post('admin/produk/delete/{id}', [ProdukController::class, 'delete'])->name('admin.produk.delete')->middleware('is_admin');
