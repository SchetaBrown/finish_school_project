<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email:rfc,dns', 'exists:users,email'],
            'password' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            // Email
            'email.required' => 'Поле email обязательно к заполнению',
            'email.string' => 'Поле email должно быть строкой',
            'email.email' => 'Неверный формат email',
            'email.exists' => 'Неверные учетные данные',
            // Пароль
            'password.required' => 'Поле пароль обязательно к заполнению',
            'password.string' => 'Поле пароль должно быть строкой',
        ];
    }
}
