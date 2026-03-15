<?php

namespace App\Http\Requests\Auth;

class StoreParticipantRequest extends BaseUserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        dd($this);
        return array_merge($this->baseRules(), [
            'birth_date' => ['required', 'date'],
            'cours_number' => ['required', 'integer', 'min:1', 'max:6'],
            'education_direction_title' => ['required', 'exists:education_directions,id']
        ]);
    }
}
