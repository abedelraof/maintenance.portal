<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $isAuthenticated = session()->get("isAuthenticated");
        if ($isAuthenticated) {
            return $next($request);
        }
        return redirect()->route("auth.login");
    }
}
