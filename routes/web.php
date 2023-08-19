<?php

use App\Http\Controllers\SaldoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TripayCallbackController;

//auth
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');
route::get('/logout', [AuthController::class, 'logout'])->middleware(['auth']);
route::get('/register', [AuthController::class, 'register']);
route::post('/register', [AuthController::class, 'store']);

// produk as akun
route::get('/produk', [ProdukController::class, 'index'])->middleware(['auth']);
route::post('/produk-store', [ProdukController::class, 'store'])->middleware(['auth']);
route::get('/produk-detail/{id}', [ProdukController::class, 'detail']);
route::get('/produk-edit/{id}', [ProdukController::class, 'edit'])->middleware(['auth']);
route::PUT('/produk-update/{id}', [ProdukController::class, 'update'])->middleware(['auth']);
route::DELETE('/produk-delete/{id}', [ProdukController::class, 'destroy'])->middleware(['auth']);

route::get('/checkout/{id}', [ProdukController::class, 'checkout'])->middleware(['auth']);
route::post('/checkout-store', [ProdukController::class, 'store_payment'])->middleware(['auth']);
route::get('/checkout-detail/{reference}', [ProdukController::class, 'detail_payment'])->name('detail_payment.detail_payment')->middleware(['auth']);

//cart
Route::post('/cart/{id}', [CartController::class, 'store'])->middleware(['auth']);
route::get('/cart', [CartController::class, 'index'])->middleware(['auth']);
route::delete('/cart-delete/{id}', [CartController::class, 'destroy'])->middleware(['auth']);

//item
route::get('/item', [ItemController::class, 'index'])->middleware(['auth', 'admin']);
route::post('/item-store', [ItemController::class, 'store'])->middleware(['auth', 'admin']);

//Admin
route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'admin']);

route::get('/admin-akun', [AdminController::class, 'akun'])->middleware(['auth', 'admin']);
route::get('/admin-item', [AdminController::class, 'item'])->middleware(['auth', 'admin']);

//Pembayaran
route::post('/callback', [TripayCallbackController::class, 'handle']);

//profile
route::get('/profile', [AuthController::class, 'profile'])->middleware(['auth']);
route::post('change-password/{id}', [AuthController::class, 'changePassword'])->middleware(['auth']);
route::post('change-profile/{id}', [AuthController::class, 'changeProfile'])->middleware(['auth']);

//Transaksi
route::get('/transaksi', [TransaksiController::class, 'transaksi'])->name('transaksi')->middleware(['auth']);
route::get('/saldo', [SaldoController::class, 'index'])->name('saldo')->middleware(['auth']);
route::get('/saldo-topup/{id}', [SaldoController::class, 'getPaymentChannel'])->middleware(['auth']);
route::post('/saldo-topup', [SaldoController::class, 'getRequestTransaction'])->middleware(['auth']);
route::get('/saldo-detail/{reference}', [SaldoController::class, 'getDetailTransaction'])->name('detail_payment')->middleware(['auth']);