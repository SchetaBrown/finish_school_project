<?php

namespace App\Http\Requests\Olympiad;

use Illuminate\Foundation\Http\FormRequest;

class StoreOlympiadOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'olympiad_id' => ['required', 'exists:olympiads,id']
        ];
    }
}
