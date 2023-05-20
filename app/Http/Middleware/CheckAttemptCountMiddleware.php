<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class CheckAttemptCountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (RateLimiter::attempt('send-message:'.auth()->id(), env('MAX_ATTEMPTS', 3), function() {}, env('DECAY_SECONDS', 120)))
            return back()->with('error', 'Too many messages sent!');

        return $next($request);
    }
}
