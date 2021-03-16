<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $products = Product::with('owner')->paginate(16);

        if(isset(auth()->user()->id)) {
            if(auth()->user()->hasRole('admin')) {
                return redirect('/dashboard');
            }
        }

        return view('home', compact('products'));
    }
}
