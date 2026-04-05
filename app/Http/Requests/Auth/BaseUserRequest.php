<?php

namespace App\Http\Requests\Auth;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseUserRequest extends FormRequest
{
    protected function baseRules(): array
    {
        return [
            'surname' => ['required', 'string'],
            'name' => ['required', 'string'],
            'patronymic' => ['required', 'string'],
            'email' => ['required', 'string', 'email:dns,rfc', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'education_school_id' => ['required', 'integer', 'exists:education_schools,id'],
            'phone' => ['required', 'string', 'regex:/^\+7 \(9\d{2}\) \d{3}-\d{2}-\d{2}$/', new PhoneRule()],
            'role' => ['required', 'string', 'exists:roles,title']
        ];
    }

    public function toBaseArray(): array
    {
        return [
            'surname' => $this->surname,
            'name' => $this->name,
            'patronymic' => $this->patronymic,
            'email' => $this->email,
            'password' => $this->password,
            'phone' => $this->phone,
        ];
    }
}
