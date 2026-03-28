<?php

namespace App\Http\Requests\Admin\Olympiad;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOlympiadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'register_start_date' => ['required', Rule::dateTime()->format('Y-m-d\\TH:i:sO')],
            'register_end_date' => ['required', Rule::dateTime()->format('Y-m-d\\TH:i:sO')],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'player_count' => ['required', 'string'],
            'player_limit' => ['required', 'string'],
            'olympiad_status_id' => ['required', 'string'],
            'olympiad_manager_id' => ['required', 'string'],
            'olympiad_direction_id' => ['required', 'string'],
        ];
    }
}
