<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('productImages')->paginate(20);
        return view('member.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('member.products.show', compact('product'));
    }
}
