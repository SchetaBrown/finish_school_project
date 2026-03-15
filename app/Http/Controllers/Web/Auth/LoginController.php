<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Manager;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return inertia('auth/Login');
    }

    public function store(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $user = Auth::user();
            $manager = Manager::where('user_id', $user->id)->first();

            if (!$manager || !$manager->is_accept) {
                Auth::logout();
                return redirect()->back()->with('info', 'Ваша заявка на рассмотрении');
            }

            return redirect()->route('olympiad.index');
        }

        return redirect()->back()->with('error', 'Неверный email или пароль');
    }
}
