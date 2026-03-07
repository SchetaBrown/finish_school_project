<?php

namespace App\Services;

use App\Action\User\StoreUserAction;
use App\Http\Requests\Auth\StoreManagerRequest;
use App\Http\Requests\Auth\StoreParticipantRequest;
use App\Models\Manager;
use App\Models\Participant;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public function storeUser(string $role, StoreUserAction $action): User
    {
        $config = match ($role) {
            'manager' => [
                'request' => StoreManagerRequest::class,
                'model' => Manager::class,
            ],
            'participant' => [
                'request' => StoreParticipantRequest::class,
                'model' => Participant::class,
            ],
            default => throw new \InvalidArgumentException('Invalid role')
        };


        $validated = app($config['request'])->validated();

        $model = app($config['model']);

        $user = $action->execute($model, $validated);

        return $user;
    }
}
