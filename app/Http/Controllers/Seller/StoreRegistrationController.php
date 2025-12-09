<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'name'   => 'required',
            'phone'  => 'required',
            'city'   => 'required',
            'address'=> 'required',
        ]);

        $user = Auth::user();

        $store = $user->store()->create([
            'name'   => $request->name,
            'phone'  => $request->phone,
            'city'   => $request->city,
            'address'=> $request->address,
            'is_verified' => false
        ]);

        return redirect()->route('seller.store.verify');
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
            'address'=> 'required',
        ]);

        $store = Auth::user()->store;

        $store->update([
            'name'   => $request->name,
            'phone'  => $request->phone,
            'city'   => $request->city,
            'address'=> $request->address,
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