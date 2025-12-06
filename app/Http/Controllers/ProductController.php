<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['images' => function($q) {
            $q->where('is_thumbnail', true);
        }])->latest()->get();

        return view('products.index', compact('products'));
    }
}
