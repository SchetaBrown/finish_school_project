<?php

namespace App\Http\Requests\Admin\Olympiad;

use Illuminate\Foundation\Http\FormRequest;

class StoreOlympiadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'register_start_date' => ['required'],
            'register_end_date' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'max_player_register_count' => ['required', 'integer'],
            'olympiad_manager_id' => ['required', 'integer'],
            'olympiad_direction_id' => ['required', 'integer'],
            'olympiad_types' => ['required'],
        ];
    }
}
