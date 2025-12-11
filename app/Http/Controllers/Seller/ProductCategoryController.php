<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{
    // LIST KATEGORI
    public function index()
    {
        $store = Auth::user()->store;

        $categories = $store->productCategories()->latest()->get();

        return view('seller.categories.index', compact('categories'));
    }

    // FORM CREATE
    public function create()
    {
        return view('seller.categories.create');
    }

    // SIMPAN KATEGORI
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100'
        ]);

        $store = Auth::user()->store;

        ProductCategory::create([
            'store_id' => $store->id,
            'name' => $request->name,
            'slug' => str()->slug($request->name),
        ]);

        return redirect()->route('seller.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    // FORM EDIT
    public function edit(ProductCategory $category)
    {
        $this->authorizeCategory($category);

        return view('seller.categories.edit', compact('category'));
    }

    // UPDATE KATEGORI
    public function update(Request $request, ProductCategory $category)
    {
        $this->authorizeCategory($category);

        $request->validate([
            'name' => 'required|min:3|max:100'
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => str()->slug($request->name),
        ]);

        return redirect()->route('seller.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    // HAPUS KATEGORI
    public function destroy(ProductCategory $category)
    {
        $this->authorizeCategory($category);

        if ($category->products()->count() > 0) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk.');
        }

        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }

    // CEK KEPEMILIKAN KATEGORI
    private function authorizeCategory(ProductCategory $category)
    {
        if ($category->store_id !== Auth::user()->store->id) {
            abort(403, 'Unauthorized category access.');
        }
    }
}

