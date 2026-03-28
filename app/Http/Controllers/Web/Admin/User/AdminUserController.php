<?php

namespace App\Http\Controllers\Web\Admin\User;

use App\Action\User\GetUsersDataForAdminPageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Resources\User\ManagerResource;
use App\Http\Resources\User\ParticipantResource;
use App\Http\Resources\User\RoleResource;
use App\Http\Resources\User\UserResource;
use App\Models\Manager;
use App\Models\Participant;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminUserController extends Controller
{
    public function index(GetUsersDataForAdminPageAction $action, Request $request)
    {
        return Inertia::render('admin/user/Index', $action->execute($request->all()));
    }

    public function create()
    {
        $roles = RoleResource::collection(Role::whereNotIn('title', ['участник', 'руководитель'])->get());

        return Inertia::render('admin/user/Create', compact(['roles']));
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $validated = $request->validated();
            User::create($validated);
            return redirect()->route('admin.user.index')->with('success', 'Пользователь создан');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Возникла ошибка, попробуйте позже');
        }
    }

    public function edit($id)
    {
        $user = User::with(['role'])->find($id);

        try {
            $resource = match ($user->role->title) {
                'Участник' => new ParticipantResource(Participant::with(['user'])->where('user_id', $user->id)->first()),
                'Руководитель' => new ManagerResource(Manager::with(['user'])->where('user_id', $user->id)->first()),
                default => new UserResource($user)
            };

            return Inertia::render('admin/user/Edit', [
                'data' => $resource
            ]);
        } catch (Exception $e) {
            return back()->with('error', 'Возникла ошибка, попробуйте позже');
        }
    }
}
