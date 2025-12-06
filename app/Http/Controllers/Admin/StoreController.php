<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::latest()->paginate(20);
        return view('admin.stores.index', compact('stores'));
    }

    public function verify($id)
    {
        $store = Store::findOrFail($id);
        $store->is_verified = true;
        $store->save();

        return back()->with('success', 'Toko berhasil diverifikasi.');
    }
}
