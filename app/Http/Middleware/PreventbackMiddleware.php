<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventbackMiddleware
{
  
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $response->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
        $response->header('Cache-Control', 'no-cache, must-revalidate, no-store, max-age=0, private');
        return $response;
    }
}
