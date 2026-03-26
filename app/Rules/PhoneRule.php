<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $request_phone = preg_replace('/[^0-9]/', '', $value);

        if (strlen($request_phone) !== 11) {
            $fail("Номер телефона должен содержать 11 цифр");
            return;
        }

        $exists = User::where('phone', $request_phone)->exists();

        if ($exists) {
            $fail("Номер телефона уже зарегистрирован в системе");
        }
    }
}
