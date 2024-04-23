<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the authenticated user is an admin
        $token = $request->header('Authorization');
       // $user = $request->user();
    // Dump and die the token
    // Dump and die the token to inspect its value
//dd($token);

// Retrieve the authenticated user

        if ($request->user() && $request->user()->role == 1) {
            return $next($request);
        }

        // If the user is not an admin, return unauthorized response
        return response()->json(['message' => 'Unauthorized','status code' => 403], 403);
    }
}
