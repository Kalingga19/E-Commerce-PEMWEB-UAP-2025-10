<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::latest()->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|max:255',
            'slug'        => 'required|unique:product_categories,slug',
            'tagline'     => 'nullable|max:60',
            'description' => 'nullable|max:500',
        ]);

        ProductCategory::create([
            'name'        => $request->name,
            'slug'        => $request->slug,
            'tagline'     => $request->tagline,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(ProductCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, ProductCategory $category)
    {
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:product_categories,slug',
            'tagline' => 'nullable|max:60',
            'description' => 'nullable|max:500',
        ]);

        $category->update([
            'name'        => $request->name,
            'slug'        => $request->slug,
            'tagline'     => $request->tagline,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(ProductCategory $category)
    {
        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }

    public function show(ProductCategory $category)
    {
        return view('admin.categories.show', compact('category'));
    }

}
