<?php

namespace App\Action\User;

use App\Http\Resources\User\UserResource;
use App\Models\Manager;
use App\Models\Participant;
use App\Models\Role;
use App\Models\User;

class GetUsersDataForAdminPageAction
{
    public function execute($search, ?int $perPage = 15)
    {
        $users = User::with(['role'])->search($search)->orderBy('role_id', 'desc')->paginate($perPage);
        $users_count = User::get()->count();

        $participants = Participant::paginate($perPage);

        $participants_count = $participants->count();

        $managers = Manager::paginate($perPage);
        $managers_count = $managers->count();

        $excludedRoles = Role::whereIn('title', ['участник', 'руководитель'])->pluck('id');
        $employees = User::with(['role'])
            ->whereNotIn('role_id', $excludedRoles)
            ->paginate($perPage);
        $employees_count = $employees->count();

        $roles = Role::get();

        return [
            'users' => UserResource::collection($users),
            'users_count' => $users_count,
            'participants' => $participants,
            'participants_count' => $participants_count,
            'managers' => $managers,
            'managers_count' => $managers_count,
            'employees' => $employees,
            'employees_count' => $employees_count,
            'roles' => $roles
        ];
    }
}
