<?php

namespace App\Http\Middleware;

use App\Http\Resources\User\ManagerResource;
use App\Http\Resources\User\ParticipantResource;
use App\Http\Resources\User\UserResource;
use App\Models\Manager;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        $authCheck = Auth::check();

        $user = $this->getUserResource();

        return array_merge(parent::share($request), [
            'csrf_token' => csrf_token(),
            'auth' => [
                'isAuthenticated' => $authCheck,
                'user' => $user
            ],
            'flash' => [
                'success' => fn() => $request->session()->get('success'),
                'error' => fn() => $request->session()->get('error'),
                'warning' => fn() => $request->session()->get('warning'),
                'info' => fn() => $request->session()->get('info'),
            ],
            'other_data' => $request->all()
        ]);
    }

    private function getUserResource()
    {
        $user = User::with(['role'])->find(auth()->id());
        if (!$user) {
            return;
        }

        if ($user->role->title === 'Участник') {
            $participant = Participant::where('user_id', $user->id)
                ->with(['educationSchool', 'attachedManager', 'olympiadOrders', 'user', 'user.role'])
                ->first();

            return new ParticipantResource($participant);
        }

        if ($user->role->title === 'Руководитель') {
            $manager = Manager::where('user_id', $user->id)
                ->with(['educationSchool', 'user', 'user.role'])
                ->first();

            return new ManagerResource($manager);
        } else {
            return new UserResource($user);
        }
    }
}
