<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role !== 'seller') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Seller access only.'
            ], 403);
        }

        return $next($request);
    }
}
