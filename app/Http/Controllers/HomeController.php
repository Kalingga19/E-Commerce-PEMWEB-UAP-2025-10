<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

class HomeController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();
        $products = Product::with('productImages')->latest()->paginate(12);

        return view('customer.home', compact('categories', 'products'));
    }
}
