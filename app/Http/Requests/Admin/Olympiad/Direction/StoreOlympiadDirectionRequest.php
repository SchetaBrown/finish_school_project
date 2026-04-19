<?php

namespace App\Http\Requests\Admin\Olympiad\Direction;

use Illuminate\Foundation\Http\FormRequest;

class StoreOlympiadDirectionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'unique:olympiad_directions,title'],
        ];
    }
}
