<?php

namespace App\Http\Requests\Auth;

class StoreManagerRequest extends BaseUserRequest
{
    public function rules(): array
    {
        return array_merge($this->baseRules(), [
            'phone' => ['required', 'string', 'regex:/^\+7 \(9\d{2}\) \d{3}-\d{2}-\d{2}$/', 'unique:managers,phone']
        ]);
    }
}
