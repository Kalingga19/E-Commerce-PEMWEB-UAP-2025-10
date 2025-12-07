<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreVerificationController extends Controller
{
    public function index()
    {
        $stores = Store::where('is_verified', false)->get();

        return view('admin.verification.index', compact('stores'));
    }

    public function approve(Store $store)
    {
        $store->update(['is_verified' => true]);

        return back()->with('success', 'Store berhasil diverifikasi.');
    }

    public function reject(Store $store)
    {
        $store->delete();

        return back()->with('success', 'Store berhasil ditolak & dihapus.');
    }
}
