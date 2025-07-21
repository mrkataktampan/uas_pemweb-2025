<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $clientKey = $request->header('Authorization');

        if ($clientKey !== env('API_KEY')) {
            return response()->json(['message' => 'Unauthorized. Invalid API Key'], 401);
        }

        return $next($request);
    }
}