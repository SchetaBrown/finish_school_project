<?php

namespace App\Action\User;

use App\Models\EducationManager;
use App\Models\EducationSchool;
use App\Models\Participant;
use App\Models\User;

class StoreManagerOrParticipantAction
{
    private array $base_input_keys = ['surname', 'name', 'patronymic', 'email', 'phone', 'password'];
    public function execute(Participant|EducationManager $model, string $role, array $data): User
    {
        $education_school = EducationSchool::where('full_name', $data['education_school_title'])->first();

        $user_data = [];
        foreach ($this->base_input_keys as $key) {
            $user_data[$key] = $data[$key];
        }

        $other_data = [];
        foreach ($data as $key => $value) {
            if (!in_array($key, $this->base_input_keys)) {
                $other_data[$key] = $value;
            }
        }

        $role_id = $role === 'manager' ? 2 : 1;
        $user = User::make($user_data);
        $user->role_id = $role_id;
        $user->save();

        $other_data['user_id'] = $user->id;
        $other_data['education_school_id'] = $education_school->id;

        $model::create($other_data);

        return $user;
    }
}
