<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseUserRequest extends FormRequest
{
    protected function baseRules(): array
    {
        return [
            'surname' => ['required', 'string', 'lowercase'],
            'name' => ['required', 'string', 'lowercase'],
            'patronymic' => ['required', 'string', 'lowercase'],
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'education_school_title' => ['required', 'string', 'exists:education_schools,full_name'],
        ];
    }

    protected function invalidRules()
    {
        return [
            'surname.required' => ''
        ];
    }
}
