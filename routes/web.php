<?php

use App\Http\Controllers\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;

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

Route::post('sign-in', LoginController::class)->name('sign-in');
Route::get('/', HomeController::class)->name('buy');
Route::get('/search', [ProductController::class, 'search']);
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);

Route::get('/dashboard', function () {
    if(auth()->user()->hasRole('admin')) {
        $needApprovalUsers = User::doesntHave('roles')->get();
        return view('admin.dashboard', compact('needApprovalUsers'));
    } elseif(auth()->user()->hasRole('customer')) {
        return redirect('/buy');
    } elseif(auth()->user()->hasRole('owner')) {
        return redirect('/orders');
    }
})->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::put('/approve/{id}', [AdminController::class, 'approve']);
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