<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class StoreRegistrationController extends Controller
{
    /**
     * Form pendaftaran toko
     */
    public function create()
    {
        return view('seller.store.register');
    }

    /**
     * Simpan pendaftaran toko
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'city'  => 'required|string|max:100',
            'address' => 'required|string|max:255',
        ]);

        // Buat toko baru (belum diverifikasi)
        Store::create([
            'user_id' => Auth::id(),
            'name'    => $request->name,
            'phone'   => $request->phone,
            'city'    => $request->city,
            'address' => $request->address,
            'is_verified' => false,
        ]);

        return redirect('/')->with('success', 'Pendaftaran toko berhasil, menunggu verifikasi admin.');
    }
}
