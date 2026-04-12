<?php

namespace App\Http\Requests\Olympiad\New;

use Illuminate\Foundation\Http\FormRequest;

class StoreOlympiadNewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'slug' => ['required', 'string', 'max:255', 'unique:news,slug'],
            'olympiad_id' => ['nullable', 'integer', 'exists:olympiads,id'],
            'published_at' => ['nullable', 'date'],
        ];
    }
}
