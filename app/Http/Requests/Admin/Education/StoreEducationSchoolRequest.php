<?php

namespace App\Http\Requests\Admin\Education;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEducationSchoolRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'min:6', 'unique:education_schools,full_name'],
            'short_name' => ['required', 'string', 'min:6', 'unique:education_schools,short_name'],
            'inn' => ['required', 'string', 'unique:education_schools,inn'],
            'phone' => ['required', 'string', 'regex:/^\+7 \(9\d{2}\) \d{3}-\d{2}-\d{2}$/', new PhoneRule()],
            'director_surname' => ['required', 'string'],
            'director_name' => ['required', 'string'],
            'director_patronymic' => ['required', 'string'],
            'email' => ['string', 'email:dns,rfc', 'unique:users,email'],
            'max_player_count' => ['integer', 'min:5', 'max:20'],
            'city' => ['nullable', 'string'],
            'education_directions' => ['nullable']
        ];
    }
}
