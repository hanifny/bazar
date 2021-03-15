<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    protected function show($id) {
        return response()->json(Product::find($id));
    }
}
