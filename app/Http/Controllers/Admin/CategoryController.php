<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // INDEX - list categories
    public function index()
    {
        $categories = ProductCategory::all();
        return view('admin.categories.index', compact('categories'));
    }

    // CREATE - form tambah kategori
    public function create()
    {
        return view('admin.categories.create');
    }

    // STORE - simpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:product_categories',
        ]);

        ProductCategory::create($request->all());

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Kategori berhasil ditambahkan.');
    }

    // EDIT - form edit kategori
    public function edit(ProductCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // UPDATE - update kategori
    public function update(Request $request, ProductCategory $category)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:product_categories,slug,' . $category->id,
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Kategori berhasil diperbarui.');
    }

    // DELETE - hapus kategori
    public function destroy(ProductCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Kategori berhasil dihapus.');
    }
}
