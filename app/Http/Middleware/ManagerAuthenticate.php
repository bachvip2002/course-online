<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class ManagerAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (auth('admin')->check()) {
            return $next($request);
        } else {
            return redirect()->route('manager.authentication.sign-in-page');
        }
    }
}
