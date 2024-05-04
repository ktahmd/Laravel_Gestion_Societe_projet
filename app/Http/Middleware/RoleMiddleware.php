<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }
        

        // If not an admin, return error response
        return response()->view('errors.403', [], 403); // 403: Forbidden
    }
}
