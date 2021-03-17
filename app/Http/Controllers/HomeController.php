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
        $products = Product::with('owner')->orderBy('created_at', 'desc')->paginate(16);
        $posts = Post::offset(0)->limit(6)->orderBy('created_at', 'desc')->get();

        return view('home', compact('products', 'posts'));
    }
}
