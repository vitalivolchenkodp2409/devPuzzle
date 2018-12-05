<?php

namespace App\Http\Middleware;

use Closure;

class Cors {

    public function handle($request, Closure $next) {     
        $allowedOrigins = ['http://myroute.xyz', 'http://clarkconcepts.net','http://localhost'];
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
        if (in_array($origin, $allowedOrigins)) {
            return $next($request)
                ->header('Access-Control-Allow-Origin', $origin)
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers',' Origin, Content-Type, Accept, Authorization, X-Request-With, cache-control,postman-token, token')
                ->header('Access-Control-Allow-Credentials',' true');
        }
        return $next($request);
    }
}