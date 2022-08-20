<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SetDefaultLanguage
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
        if (session('locale') || !auth()->check())
            return $next($request);

        app()->setLocale(setting('default_lang', app()->getLocale()));
        session(['locale' => app()->getLocale()]);
        LaravelLocalization::setLocale(app()->getLocale());

        return redirect(LaravelLocalization::getLocalizedUrl());
    }
}
