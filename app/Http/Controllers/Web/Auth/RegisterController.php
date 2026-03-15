<?php

namespace App\Http\Controllers\Web\Auth;

use App\Action\User\StoreManagerOrParticipantAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Education\EducationSchoolResource;
use App\Models\EducationSchool;
use App\Models\Manager;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        $schools = EducationSchoolResource::collection(EducationSchool::with(['directions'])->get());

        return inertia('auth/Register', compact('schools'));
    }

    public function store(Request $request, UserServiceInterface $userService, StoreManagerOrParticipantAction $action)
    {
        $user = $userService->storeUser($request->input('role'), $action);

        $manager = Manager::where('user_id', $user->id)->first();

        if (!$manager || !$manager->is_accept) {
            return redirect()->route('olympiad.index')->with('info', 'Заявка оставлена');
        }

        Auth::login($user);

        return redirect()->route('olympiad.index')->with('success', 'Регистрация успешна');
    }
}
