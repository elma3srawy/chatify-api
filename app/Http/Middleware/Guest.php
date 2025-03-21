<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->currentAccessToken()) {
            return response()->json([
                'message' => 'You are already authenticated. Please log out to access this page.',

            ], Response::HTTP_FORBIDDEN);
        }

        // Allow unauthenticated users to proceed
        return $next($request);
    }
}