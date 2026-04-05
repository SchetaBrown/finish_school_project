<?php

namespace App\Http\Requests\Admin\Education\Direction;

use Illuminate\Foundation\Http\FormRequest;

class StoreEducationDirectionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => ['required', 'string'],
            'title' => ['required', 'string'],
        ];
    }
}
