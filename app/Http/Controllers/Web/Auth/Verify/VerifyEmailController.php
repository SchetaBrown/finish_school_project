<?php

namespace App\Http\Controllers\Web\Auth\Verify;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('olympiad.index'));
        }

        $request->fulfill();

        return redirect()->intended(route('olympiad.index'));
    }
}
