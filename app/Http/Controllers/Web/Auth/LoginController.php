<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return inertia('auth/Login');
    }

    public function store(LoginRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return redirect()->back()
                ->with('error', 'Неверный email или пароль');
        }

        $user = User::with('role')->find(Auth::id());

        if ($user->isOlympiadManager()) {
            $manager = Manager::where('user_id', $user->id)->first();

            if (!$manager || $manager->is_accept === false) {
                Auth::logout();
                return redirect()->back()
                    ->with('info', 'Ваша заявка в рассмотрении');
            }
        }

        return redirect()->intended();
    }
}
