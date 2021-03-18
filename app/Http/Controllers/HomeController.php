<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        if(auth()->check()) {
            $products = Product::with('owner')->where('owner_id', '!=', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(16);
        } else {
            $products = Product::with('owner')->orderBy('created_at', 'desc')->paginate(16);
        }
        
        $posts = Post::offset(0)->limit(8)->orderBy('created_at', 'desc')->get();

        return view('home', compact('products', 'posts'));
    }
}
