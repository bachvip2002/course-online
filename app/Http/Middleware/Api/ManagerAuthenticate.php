<?php

namespace App\Http\Middleware;

use App\Helper\HttpStatusCode;
use Closure;
use Illuminate\Http\Request;

class ManagerAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (auth('sanctum')->check()) {
            return $next($request);
        } else {
            return response()->json([
                'message' => 'failed'
            ], HttpStatusCode::UNAUTHORIZED);
        }
    }
}
