<?php

namespace App\Action\User;

use App\Models\Manager;
use App\Models\Participant;
use App\Models\Role;
use App\Models\User;

class GetUsersDataForAdminPageAction
{
    public function execute(?int $perPage = 15)
    {
        $users = User::paginate($perPage);
        $users_count = $users->count();

        $participants = Participant::paginate($perPage);
        $participants_count = $participants->count();

        $managers = Manager::paginate($perPage);
        $managers_count = $managers->count();

        $excludedRoles = Role::whereIn('title', ['участник', 'руководитель'])->pluck('id');
        $employees = User::with(['role'])
            ->whereNotIn('role_id', $excludedRoles)
            ->paginate($perPage);

        return compact(['users', 'users_count', 'participants', 'participants_count', 'managers', 'managers_count', 'employees']);
    }
}
