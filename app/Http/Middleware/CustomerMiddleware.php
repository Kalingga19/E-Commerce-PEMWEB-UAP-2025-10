<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role !== 'customer') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Customer access only.'
            ], 403);
        }

        return $next($request);
    }
}
