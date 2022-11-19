<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Backend\EmailController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
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
        View::share(['emails_not_seen_count' => (new EmailController)->count()]);

        if (session('locale') || !auth()->check() || app()->runningInConsole())
            return $next($request);

        app()->setLocale(setting('default_lang') ?? app()->getLocale());
        session(['locale' => app()->getLocale()]);
        LaravelLocalization::setLocale(app()->getLocale());

        if ($request->route()->uri() == '/')
            return redirect($request->route()->uri());

        return redirect(LaravelLocalization::getLocalizedUrl());
    }
}
