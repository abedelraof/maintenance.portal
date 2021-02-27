<?php

namespace App\Http\Middleware;

use App\Http\Helpers\DatabaseHelper;
use App\Models\ConnectionMapping;
use Closure;
use Illuminate\Http\Request;

class CheckSubdomain
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
        $domain = $_SERVER['HTTP_HOST'];
        $arr = explode(".", $domain);
        $subdomain = reset($arr);
        // check domain.
        $connection = ConnectionMapping::query()->where("domain", strtolower($domain))->first();
        if ($connection) {
            DatabaseHelper::getInstance()->initConnections($connection);
            return $next($request);
        }
        // if not check subdomain
        $connection = ConnectionMapping::query()->where("subdomain", strtolower($subdomain))->first();
        if ($connection) {
            DatabaseHelper::getInstance()->initConnections($connection);
            return $next($request);
        }
        // if not abort404
        abort(404);
    }


}
