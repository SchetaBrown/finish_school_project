<?php

namespace App\Http\Controllers\Web\Auth\Verify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmailVerificationPromptController extends Controller
{
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail() ? redirect()->intended(route('olympiad.index')) : Inertia::render('auth/VerifyEmail');
    }
}
