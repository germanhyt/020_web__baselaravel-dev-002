<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    //

    public function index()
    {
        $products = Product::all();

        return view('product.index', compact('products'));
    }
}
