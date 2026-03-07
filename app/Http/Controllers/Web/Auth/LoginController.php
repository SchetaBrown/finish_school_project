<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
            return redirect()->route('olympiad.index');
        } else {
            return redirect()->back()->with('success', 'Произошла ошибка');
        }
    }

    public function destroy()
    {

    }
}
