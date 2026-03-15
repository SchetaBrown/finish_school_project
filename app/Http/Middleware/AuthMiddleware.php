<?php

namespace App\Http\Middleware;

use App\Models\Manager;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login.create')->with('error', 'Войдите в систему');
        }

        $manager = Manager::where('user_id', Auth::id())->first();

        if ($manager && $manager->is_accept) {
            return $next($request);
        }

        return redirect()->route('olympiad.index')->with('info', 'Ваша заявка на рассмотрении');
    }
}
