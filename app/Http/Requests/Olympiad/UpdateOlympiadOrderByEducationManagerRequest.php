<?php

namespace App\Http\Requests\Olympiad;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOlympiadOrderByEducationManagerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'reject_message' => ['nullable', 'max:100']
        ];
    }
}
