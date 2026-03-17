<?php

namespace App\Http\Controllers\Web\Auth\Verify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('olympiad.index'));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Письмо отправлено');
    }
}
