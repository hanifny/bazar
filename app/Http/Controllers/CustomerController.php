<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    protected function index() {
        $products = Product::with('owner')->paginate(16);

        return view('buy', compact('products'));
    }

    protected function buy(Request $request) {
        Order::create($request->except('_token'));
        toast('Pesanan berhasil dibuat', 'success');
        return redirect('/buy');
    }

    protected function riwayat() {
        $riwayat = User::with('orders.product')->find(Auth::user()->id);
        
        return view('riwayat', compact('riwayat'));
    }

    protected function search(Request $request) {
        $products = Product::with('owner')->where('name', 'like', '%' . $request->text . '%' )->paginate(16);

        return view('load', compact('products'))->render();
    }
}
