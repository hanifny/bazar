<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;

require __DIR__.'/auth.php';

Route::post('sign-in', LoginController::class)->name('sign-in');
Route::get('/', HomeController::class)->name('buy');
Route::get('/search', [ProductController::class, 'search']);
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/information', [AdminController::class, 'indexInfo'])->name('information');
Route::get('/information/{id}', [AdminController::class, 'showInfo']);

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::put('/approve/{id}', [AdminController::class, 'approve']);
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/information-adm', [AdminController::class, 'information'])->name('information-adm');
    Route::post('/information', [AdminController::class, 'storeInfo']);
    Route::get('/get-information/{id}', [AdminController::class, 'getInfo']);
    Route::delete('/information/{id}', [AdminController::class, 'destroyInfo']);
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/cart', [ProductController::class, 'cart']);
    Route::get('/history', [ProductController::class, 'history'])->name('history');
    Route::post('/cart', [ProductController::class, 'moveToCart']);
    Route::post('/buy', [ProductController::class, 'buy']);
});

Route::group(['middleware' => ['auth', 'role:owner']], function () {
    Route::get('/orders', [OwnerController::class, 'orders'])->name('orders');
    Route::get('/products', [OwnerController::class, 'products'])->name('products');
    Route::post('/product', [OwnerController::class, 'store']);
    Route::delete('/product/{id}', [OwnerController::class, 'destroy']);
});