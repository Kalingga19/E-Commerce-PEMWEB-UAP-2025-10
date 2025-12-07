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
        if ($user->role !== 'member') {
            return abort(403, 'Access denied. Seller only.');
        }

        // User harus punya store
        if (!$user->store) {
            return abort(403, 'You do not have a store.');
        }

        // Store harus sudah diverifikasi admin
        if (!$user->store->is_verified) {
            return abort(403, 'Store not verified by admin.');
        }

        return $next($request);
    }
}
