<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');

Route::get('/payment-checkout', [CartController::class, 'mercadoPagoCheckout'])->name('payment.checkout')->middleware('auth');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users-ajax', [UserController::class, 'list'])->name('users.ajax');
    Route::get('/create-user', [UserController::class, 'create'])->name('create.user');
    Route::post('/store-user', [UserController::class, 'store'])->name('store.user');
    
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/products-ajax', [ProductController::class, 'list'])->name('products.ajax');
    Route::get('/create-product', [ProductController::class, 'create'])->name('create.product');
    Route::post('/store-product', [ProductController::class, 'store'])->name('store.product');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware('admin');
});
