<?php

namespace App\Services\Interfaces;

use App\Action\User\StoreManagerOrParticipantAction;
use App\Models\User;

interface UserServiceInterface
{
    public function storeUser(string $role, StoreManagerOrParticipantAction $action): User;
}
