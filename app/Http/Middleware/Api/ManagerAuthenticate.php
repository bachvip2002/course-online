<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagerAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (auth('sanctum')->check()) {
            return $next($request);
        } else {
            return response()->json([
                'message' => 'failed'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
