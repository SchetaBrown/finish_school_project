<?php

namespace App\Http\Requests\Admin\Education\Direction;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEducationDirectionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'code' => ['required', 'string'],
        ];
    }
}
