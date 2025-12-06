<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // role salah
        if ($user->role !== 'member') {
            abort(403, 'Anda bukan member.');
        }

        // belum buat toko
        if (!$user->store) {
            abort(403, 'Anda belum memiliki toko.');
        }

        return $next($request);
    }
}
