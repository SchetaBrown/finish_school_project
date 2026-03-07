<?php

namespace App\Services\Interfaces;

use App\Action\User\StoreUserAction;
use App\Models\User;

interface UserServiceInterface
{
    public function storeUser(string $role, StoreUserAction $action): User;
}
