<?php

namespace App\Http\Requests\Education;

use Illuminate\Foundation\Http\FormRequest;

class CreateEducationSchoolRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'min:6', 'unique:education_schools,full_name'],
            'short_name' => ['required', 'string', 'min:6', 'unique:education_schools,short_name'],
        ];
    }
}
