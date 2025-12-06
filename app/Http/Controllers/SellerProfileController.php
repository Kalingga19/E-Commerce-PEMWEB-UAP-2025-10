<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellerProfileController extends Controller
{
    public function index()
    {
        $store = auth()->user()->store;

        if (!$store) {
            abort(404, 'Store not found');
        }

        return view('seller.profile', compact('store'));
    }


    public function update(Request $request)
    {
        $store = auth()->user()->store;

        if (!$store) {
            abort(404, 'Store not found');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',

            // BANK
            'bank_name' => 'required|string|max:50',
            'account_number' => 'required|string|max:50',
            'account_holder_name' => 'required|string|max:100',

            // LOGO
            'logo' => 'nullable|image|max:2048'
        ]);

        // Update logo jika ada upload baru
        if ($request->hasFile('logo')) {

            // Hapus file lama
            if ($store->logo && Storage::disk('public')->exists($store->logo)) {
                Storage::disk('public')->delete($store->logo);
            }

            $path = $request->file('logo')->store('stores', 'public');
            $store->logo = $path;
        }

        // Update data toko
        $store->name = $request->name;
        $store->description = $request->description;
        $store->address = $request->address;
        $store->phone = $request->phone;
        $store->email = $request->email;

        // Update rekening
        $store->bank_name = $request->bank_name;
        $store->account_number = $request->account_number;
        $store->account_holder_name = $request->account_holder_name;

        $store->save();

        return back()->with('success', 'Profil toko berhasil diperbarui.');
    }
}
