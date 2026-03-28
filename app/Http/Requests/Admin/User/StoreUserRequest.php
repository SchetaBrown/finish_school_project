<?php

namespace App\Http\Requests\Admin\User;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'surname' => ['required', 'string'],
            'name' => ['required', 'string'],
            'patronymic' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'string', 'regex:/^\+7 \(9\d{2}\) \d{3}-\d{2}-\d{2}$/', new PhoneRule()],
            'role_id' => ['required', 'string', 'exists:roles,id'],
        ];
    }
}
