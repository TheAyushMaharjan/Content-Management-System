<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleCors
{
    public function handle(Request $request, Closure $next)
    {
        // Handle pre-flight OPTIONS request
        if ($request->getMethod() == "OPTIONS") {
            return response()->json([], 200)
                ->header('Access-Control-Allow-Origin', 'http://localhost:5174')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Requested-With');
        }
    
        return $next($request)
            ->header('Access-Control-Allow-Origin', 'http://localhost:5174')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Requested-With');
    }
    
}
