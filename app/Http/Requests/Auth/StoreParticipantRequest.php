<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Auth\BaseUserRequest;

class StoreParticipantRequest extends BaseUserRequest
{
    public function rules(): array
    {
        return array_merge($this->baseRules(), [
            'birth_date' => ['required', 'date'],
            'cours_number' => ['required', 'integer', 'min:1', 'max:6'],
        ]);
    }
}
