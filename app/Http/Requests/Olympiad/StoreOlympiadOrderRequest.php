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
            'arrival_date' => ['date', new HostelRule()],
            'departure_date' => ['date', new HostelRule()],
            'manager_id' => ['required', 'exists:managers,id'],
        ];
    }
}
