<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function create()
    {
        return inertia('auth/Login');
    }

    public function store(LoginRequest $request)
    {

    }

    public function destroy()
    {

    }
}
