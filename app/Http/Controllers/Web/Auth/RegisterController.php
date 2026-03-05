<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreManagerRequest;
use App\Http\Requests\Auth\StoreParticipantRequest;

class RegisterController extends Controller
{
    public function create()
    {
        return inertia('auth/Register');
    }

    public function storeManagar(StoreManagerRequest $request)
    {

    }

    public function storeParticipant(StoreParticipantRequest $request)
    {

    }
}
