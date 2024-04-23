<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Check if the authenticated user is a client
       if ($request->user() && $request->user()->role == 2) {
        return $next($request);
    }

    // If the user is not a client, return unauthorized response
    return response()->json(['message' => 'Unauthorized'], 403);
    }
}
