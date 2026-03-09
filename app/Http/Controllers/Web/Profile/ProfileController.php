<?php

namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Controller;
use Auth;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        return Inertia::render('profile/Index');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect()->route('olympiad.index');
    }
}
