<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsMember
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'member') {
            return abort(403, 'Access denied. Member only.');
        }

        return $next($request);
    }
}
