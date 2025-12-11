<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSeller
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        // Role harus member
        if ($user->role !== 'seller') {
            return abort(403, 'Access denied. Seller only.');
        }

        // User harus punya store
        if (!$user->store) {
            return redirect()->route('store.register')->with('error', 'Silakan buat toko terlebih dahulu.');
        }

        if (!$user->store) {
            abort(403, 'YOU DO NOT HAVE A STORE.');
        }

        // Store harus sudah diverifikasi admin
        if (!$user->store->is_verified) {
            return abort(403, 'Store not verified by admin.');
        }

        return $next($request);
    }
}
