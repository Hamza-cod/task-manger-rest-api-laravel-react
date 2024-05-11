<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Header\Headers;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (Headers)  $next
     */
    
    public function handle(Request $request, Closure $next) : Headers
    {
        return $next($request)->header('Access-Control-Allow-Origin', '*')
      ->header('Access-Control-Allow-Methods', '*')
      ->header('Access-Control-Allow-Headers',' Origin, Content-Type, Accept, Authorization, X-Request-With')
      ->header('Access-Control-Allow-Credentials',' true');
    }
}
