<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function create()
    {
        return inertia('auth/Register');
    }

    public function store(RegisterRequest $request)
    {

    }
}
