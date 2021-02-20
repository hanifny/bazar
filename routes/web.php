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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $needApprovalUsers = User::doesntHave('roles')->get();
    return view('dashboard', compact('needApprovalUsers'));
})->middleware(['auth', 'role:admin'])->name('dashboard');

require __DIR__.'/auth.php';

Route::post('sign-in', LoginController::class)->name('sign-in');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::put('/approve/{id}', [AdminController::class, 'approve']);
});

Route::group(['middleware' => ['auth', 'role:customer']], function () {
    Route::get('/buy', [CustomerController::class, 'index'])->name('buy');
    Route::get('/search', [CustomerController::class, 'search']);
    Route::post('/buy', [CustomerController::class, 'buy']);
    Route::get('/riwayat', [CustomerController::class, 'riwayat'])->name('riwayat');
});

Route::group(['middleware' => ['auth', 'role:owner']], function () {
    Route::get('/orders', [OwnerController::class, 'orders'])->name('orders');
    Route::get('/products', [OwnerController::class, 'products'])->name('products');
    Route::get('/product/{id}', [OwnerController::class, 'show']);
    Route::post('/product', [OwnerController::class, 'store']);
    Route::delete('/product/{id}', [OwnerController::class, 'destroy']);
});