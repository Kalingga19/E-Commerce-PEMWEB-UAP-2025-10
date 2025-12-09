<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreVerificationController extends Controller
{
    // Tampilkan semua toko yang belum diverifikasi
    public function index()
    {
        $stores = Store::where('is_verified', 0)->get();

        return view('admin.verification.index', compact('stores'));
    }

    // Approve toko
    public function approve(Store $store)
    {
        $store->update([
            'is_verified' => 1
        ]);

        return back()->with('success', 'Toko berhasil disetujui!');
    }

    // Reject toko
    public function reject(Store $store, Request $request)
    {
        $request->validate([
            'reason' => 'required|string'
        ]);

        $store->update([
            'is_verified' => -1,
            'verification_note' => $request->reason,
        ]);

        return back()->with('error', 'Toko telah ditolak dengan alasan.');
    }
}
