<?php

namespace App\Rules;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\ValidationRule;

class HostelRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $request = request();
        if ($value === true) {
            if (!$request->has('arrival_date') || !$request->has('depature_date')) {
                $fail('Укажите дату');
            }
        }
    }
}
