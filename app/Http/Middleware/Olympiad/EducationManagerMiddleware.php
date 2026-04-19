<?php

namespace App\Http\Middleware\Olympiad;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EducationManagerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->isManager()) {
            return redirect()->back()->with('warning', 'Доступ запрещен');
        }

        return $next($request);
    }
}
