<?php

namespace App\Http\Requests\Auth;

class StoreManagerRequest extends BaseUserRequest
{
    public function rules(): array
    {
        return $this->baseRules();
    }
}
