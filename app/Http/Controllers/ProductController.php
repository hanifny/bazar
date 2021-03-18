<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    protected function userId() {
        return Auth::user()->id;
    }
    
    protected function index() {
        if(auth()->check()) {
            $products = Product::with('owner')->where('owner_id', '!=', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(44);
        } else {
            $products = Product::with('owner')->orderBy('created_at', 'desc')->paginate(44);
        }

        return view('product', compact('products'));
    }

    protected function show($id) {
        return response()->json(Product::with('owner')->find($id));
    }

    protected function search(Request $request) {
        $products = Product::with('owner')->where('name', 'like', '%' . $request->text . '%' )->paginate(16);

        return view('components.products', compact('products'))->render();
    }

    protected function cart() {
        $cart = Order::where(['customer_id' => auth()->user()->id, 'in_cart' => 1])->get();

        return view('cart', compact('cart'));
    }

    protected function moveToCart(Request $request) {
        Order::create($request->except('_token'));
        Alert::success('Pesanan berhasil dibuat', '');
        return redirect('/product');
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
                ->where('customer_id', Auth::user()->id)
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
        
        return view('history', compact('riwayat'));
    }
}
