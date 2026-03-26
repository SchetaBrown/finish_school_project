<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Auth\BaseUserRequest;

class StoreManagerRequest extends BaseUserRequest
{
    public function rules(): array
    {
        return $this->baseRules();
    }
}
