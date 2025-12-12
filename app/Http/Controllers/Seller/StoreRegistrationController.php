<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\StoreNeedsVerification;
use App\Models\Store;
use App\Models\User;

class StoreRegistrationController extends Controller
{
    // STEP 1 - buat toko
    public function create()
    {
        return view('seller.store.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'city' => 'required|string|max:100',
            'address' => 'required|string',
            'about' => 'nullable|string',
        ]);

        $store = Store::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'city' => $request->city,
            'address' => $request->address,
            'about' => $request->about,
            'is_verified' => false,
            'address_id' => $request->address_id,
        ]);

        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new StoreNeedsVerification($store));
        }

        return redirect()->route('dashboard')
            ->with('success', 'Toko berhasil didaftarkan dan menunggu verifikasi admin.');
    }


    public function submitVerification(Request $request)
    {
        $request->validate([
            'verification_document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $store = Auth::user()->store;

        $path = $request->verification_document->store('verification', 'public');

        $store->update([
            'verification_document' => $path,
            'is_verified' => false, // pending
        ]);

        return redirect()->route('seller.store.complete');
    }

    // STEP 3 - Complete
    public function complete()
    {
        return view('seller.store.complete');
    }
    // Edit store info
    public function edit()
    {
        $store = Auth::user()->store;
        return view('seller.store.register', compact('store'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'phone'  => 'required',
            'city'   => 'required',
            'address' => 'required',
        ]);

        $store = Auth::user()->store;

        $store->update([
            'name'   => $request->name,
            'phone'  => $request->phone,
            'city'   => $request->city,
            'address' => $request->address,
        ]);

        return redirect()->route('seller.dashboard')->with('success', 'Informasi toko berhasil diperbarui.');
    }

    public function verify()
    {
        $store = auth()->user()->store;

        if (!$store) {
            return redirect()->route('store.register');
        }

        return view('seller.store.verify', compact('store'));
    }

    public function verifyStore(Request $request)
    {
        $request->validate([
            'verification_document' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $store = auth()->user()->store;

        // simpan file
        $path = $request->file('verification_document')->store('verification', 'public');

        $store->update([
            'verification_document' => $path,
            'is_verified' => false, // tetap 0
        ]);

        return redirect()->route('store.register.completed');
    }

    public function completed()
    {
        return view('seller.store.completed');
    }
}
