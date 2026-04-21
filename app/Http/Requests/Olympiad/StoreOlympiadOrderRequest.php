<?php

namespace App\Http\Requests\Olympiad;

use App\Rules\HostelRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOlympiadOrderRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            'is_hostel' => ['boolean', new HostelRule()],
            'arrival_date' => ['nullable', 'date', new HostelRule()],
            'departure_date' => ['nullable', 'date', new HostelRule()],
            'education_manager_id' => ['required', 'exists:education_managers,id'],
        ];
    }
}
