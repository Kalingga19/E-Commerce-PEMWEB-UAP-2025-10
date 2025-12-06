<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

class HomeController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::orderBy('name')->get();

        $latestProducts = Product::with('images')
            ->orderBy('created_at', 'desc')
            ->take(12)
            ->get();

        return view('pages.home', compact('categories', 'latestProducts'));
    }
}
