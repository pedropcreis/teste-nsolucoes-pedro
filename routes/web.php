<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
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

Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('auth');
Route::get('/users-ajax', [UserController::class, 'list'])->name('users.ajax')->middleware('auth');
Route::get('/create-user', [UserController::class, 'create'])->name('create.user')->middleware('auth');
Route::post('/store-user', [UserController::class, 'store'])->name('store.user')->middleware('auth');

Route::get('/products', [ProductController::class, 'index'])->name('products')->middleware('auth');
Route::get('/products-ajax', [ProductController::class, 'list'])->name('products.ajax')->middleware('auth');
Route::get('/create-product', [ProductController::class, 'create'])->name('create.product')->middleware('auth');
Route::post('/store-product', [ProductController::class, 'store'])->name('store.product')->middleware('auth');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
