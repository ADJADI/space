<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->secure() && app()->environment('production')) {
            return redirect()->secure($request->getRequestUri());
        }
        
        $response = $next($request);
        
        if (app()->environment('production')) {
            // Add security headers
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
            $response->headers->set('X-Content-Type-Options', 'nosniff');
            $response->headers->set('X-XSS-Protection', '1; mode=block');
            $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
            $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
            $response->headers->set('Content-Security-Policy', "default-src 'self' https: data:; img-src * data:; font-src * data:; style-src 'self' 'unsafe-inline' https:; script-src 'self' 'unsafe-inline' https:;");
        }
        
        return $response;
    }
} 