<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $is_admin = false;
        Auth::user()->roles()->each(function ($role) use ($is_admin) {
            if ($role->title === 'администратор') {
                $is_admin = true;
                return false;
            }
        });

        if (!$is_admin) {
            return redirect()->back()->with('error', 'Повысьте уровень доступа.');
        }

        return $next($request);
    }
}
