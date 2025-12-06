<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Jika dia seller → kirim data store
        $store = $user->store ?? null;

        return view('profile.dashboard', compact('user', 'store'));
    }
}
