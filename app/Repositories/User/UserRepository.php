<?php

namespace App\Repositories\User;

use App\Http\Resources\User\ManagerResource;
use App\Http\Resources\User\ParticipantResource;
use App\Models\Manager;
use App\Models\Participant;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    // Получение всех участников
    public function getAllParticipants()
    {
        return ParticipantResource::collection(Participant::with(['user', 'attachedManager', 'educationSchool', 'olympiadApplications'])->paginate(parent::PER_PAGE));
    }

    // Получение всех руководителей
    public function getAllManagers()
    {
        return ManagerResource::collection(Manager::with(['user', 'school'])->paginate(parent::PER_PAGE));
    }
}
