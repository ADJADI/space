<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to access the admin area.');
        }
        
        if (Auth::user()->isAdmin()) {
            return $next($request);
        }
        
        Log::warning('Non-admin user attempted to access admin area', [
            'user_id' => Auth::id(),
            'email' => Auth::user()->email,
            'role' => Auth::user()->role ?? 'no role set',
        ]);
        
        return redirect()->route('login')->with('error', 'You do not have admin access.');
    }
}
