<?php

namespace App\Http\Requests\Auth;

class StoreParticipantRequest extends BaseUserRequest
{
    public function rules(): array
    {
        return array_merge($this->baseRules(), [
            // 'education_direction_title' => ['required', 'exists:education_directions,title'],
            'birth_date' => ['required', 'date'],
            'cours_number' => ['required', 'integer', 'min:1', 'max:6'],
        ]);
    }
}
