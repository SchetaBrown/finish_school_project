<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class ShareRecaptchaKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->routeIs('login.*') || $request->routeIs('register.*')) {
            Inertia::share('recaptcha_site_key', env('YANDEX_RECAPTCHA_CLIENT_KEY'));
        }

        return $next($request);
    }
}
