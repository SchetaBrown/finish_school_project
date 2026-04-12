<?php

namespace App\Http\Middleware\Olympiad;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OlympiadManagerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->isOlympiadManager()) {
            return redirect()->back()->with('warning', 'Доступ запрещен');
        }

        return $next($request);
    }
}
