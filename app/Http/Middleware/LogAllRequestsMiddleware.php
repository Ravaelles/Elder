<?php

namespace App\Http\Middleware;

use Closure;

class LogAllRequestsMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $uri = $_SERVER['REQUEST_URI'];
        $ip = $request->ip();
        \Log::info("$ip $uri");
        return $next($request);
    }

}
