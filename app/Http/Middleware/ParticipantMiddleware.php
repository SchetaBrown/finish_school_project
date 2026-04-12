<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParticipantMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->isParticipant()) {
            return redirect()->back()->with('info', 'Для записи нужно иметь роль участника');
        }

        return $next($request);
    }
}
