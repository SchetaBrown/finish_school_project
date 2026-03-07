<?php

namespace App\Http\Controllers\Web\Auth;

use App\Action\User\StoreUserAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Education\EducationSchoolResource;
use App\Models\EducationDirection;
use App\Models\EducationSchool;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct()
    {

    }

    public function create()
    {
        $schools = EducationSchoolResource::collection(EducationSchool::get());
        $directions = EducationDirection::with(['schools'])->get();

        return inertia('auth/Register', compact('schools', 'directions'));
    }

    public function store(Request $request, UserServiceInterface $userService, StoreUserAction $action)
    {
        $user = $userService->storeUser($request->input('role'), $action);

        Auth::login($user);

        return redirect()->route('olympiad.index')->with('success', 'Регистрация успешна');
    }
}
