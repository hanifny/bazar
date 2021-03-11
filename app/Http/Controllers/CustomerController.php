<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    protected function index() {
        $products = Product::with('owner')->paginate(16);

        if(isset(auth()->user()->id)) {
            if(auth()->user()->hasRole('admin')) {
                return redirect('/dashboard');
            }
        }

        return view('customer.buy', compact('products'));
    }

    protected function moveToCart(Request $request) {
        Order::create($request->except('_token'));
        toast('Pesanan berhasil dibuat', 'success');
        return redirect('/');
    }

    protected function cart() {
        $cart = Order::where(['customer_id' => auth()->user()->id, 'in_cart' => 1])->get();

        return view('customer.cart', compact('cart'));
    }

    protected function buy(Request $request) {
        Order::whereIn('id', $request->except('_token'))->update([
            'in_cart' => 0,
            'cart' => 'CART/'.Auth::user()->id.'/'.rand(0,99999),
        ]);
        Alert::success('Terimakasih sudah berbelanja!', '');
        return redirect('/history');
    }

    protected function history() {
        $carts = Order::orderBy('updated_at', 'desc')
                ->select('cart')
                ->get()
                ->unique('cart')
                ->pluck('cart');
        // $carts = DB::table('orders')->where('customer_id', Auth::user()->id)->select('cart')->groupBy('cart')->get();

        $riwayat = [];
        foreach($carts as $cart) {
            if(!is_null($cart)) {
                array_push($riwayat, Order::where('cart', $cart)->with('product.owner')->get());
            }
        }

        $page = null;
        $options = ['path' => '/history'];
        $perPage = 1;

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $riwayat instanceof Collection ? $riwayat : Collection::make($riwayat);
        $riwayat = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
        
        return view('customer.history', compact('riwayat'));
    }

    protected function search(Request $request) {
        $products = Product::with('owner')->where('name', 'like', '%' . $request->text . '%' )->paginate(16);

        return view('customer.load', compact('products'))->render();
    }
}
