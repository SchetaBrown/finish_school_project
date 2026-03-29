<?php

namespace App\Http\Middleware;

use App\Models\Manager;
use App\Models\Participant;
use App\Models\User;
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

        $user = User::with(['role'])->first();
        $id = Auth::id();

        if ($user->role->title === 'участник') {
            $participant = Participant::where('user_id', $id)->first();

            if (!$participant) {
                return redirect()->route('login.create');
            }

        } else if ($user->role->title === 'руководитель') {
            $manager = Manager::where('user_id', $id)->first();

            if (!$manager || !$manager->is_accept) {
                return redirect()->route('olympiad.index')->with('info', 'Ваша заявка на рассмотрении');
            }
        }

        return $next($request);
    }
}
