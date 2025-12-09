<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['store', 'category'])
            ->latest()
            ->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'category_id' => 'required|exists:product_categories,id',
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }

    public function suspend(Product $product)
    {
        $product->status = 'inactive';
        $product->save();

        return back()->with('success', 'Produk telah disuspend.');
    }

    public function activate(Product $product)
    {
        $product->status = 'active';
        $product->save();

        return back()->with('success', 'Produk telah diaktifkan kembali.');
    }
}
