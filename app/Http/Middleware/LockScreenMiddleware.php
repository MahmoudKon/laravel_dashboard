<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LockScreenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return session()->get('locked') == true && stripos($request->route()->uri, 'lockscreen') === false
                ? redirect()->route('lock')
                : $next($request);
    }
}
