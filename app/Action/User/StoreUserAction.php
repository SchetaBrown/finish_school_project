<?php

namespace App\Action\User;

use App\Models\EducationSchool;
use App\Models\Manager;
use App\Models\Participant;
use App\Models\User;

class StoreUserAction
{
    public function execute(Participant|Manager $model, array $data): User
    {
        $base_input_keys = ['surname', 'name', 'patronymic', 'email', 'password'];
        $education_school = EducationSchool::where('full_name', $data['education_school_title'])->first();

        $user_data = [];
        foreach ($base_input_keys as $key) {
            $user_data[$key] = $data[$key];
        }

        $other_data = [];
        foreach ($data as $key => $value) {
            if (!in_array($key, $base_input_keys)) {
                $other_data[$key] = $value;
            }
        }

        $user = User::create($user_data);

        $other_data['user_id'] = $user->id;
        $other_data['education_school_id'] = $education_school->id;

        $model::create($other_data);

        return $user;
    }
}
