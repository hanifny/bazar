<?php

use App\Http\Controllers\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\CustomerController;

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

Route::get('/', [CustomerController::class, 'index'])->name('buy');
Route::get('/search', [CustomerController::class, 'search']);

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

Route::post('sign-in', LoginController::class)->name('sign-in');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::put('/approve/{id}', [AdminController::class, 'approve']);
});

Route::group(['middleware' => ['auth', 'role:customer']], function () {
    Route::get('/cart', [CustomerController::class, 'cart'])->name('cart');
    Route::get('/history', [CustomerController::class, 'history'])->name('history');
    Route::post('/cart', [CustomerController::class, 'moveToCart']);
    Route::post('/buy', [CustomerController::class, 'buy']);
});

Route::group(['middleware' => ['auth', 'role:owner']], function () {
    Route::get('/orders', [OwnerController::class, 'orders'])->name('orders');
    Route::get('/products', [OwnerController::class, 'products'])->name('products');
    Route::get('/product/{id}', [OwnerController::class, 'show']);
    Route::post('/product', [OwnerController::class, 'store']);
    Route::delete('/product/{id}', [OwnerController::class, 'destroy']);
});