<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class YandexCaptchaRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($value)) {
            $fail('Капча не пройдена');
            return;
        }

        try {
            $response = Http::timeout(1)
                ->asForm()
                ->post('https://smartcaptcha.cloud.yandex.ru/validate', [
                    'secret' => config('services.yandex_captcha.server_key'),
                    'token' => $value,
                    'ip' => $this->ip ?? request()->ip(),
                ]);

            if ($response->failed()) {
                \Log::warning('Yandex Captcha service unavailable', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return;
            }

            $data = $response->json();

            if (!isset($data['status']) || $data['status'] !== 'ok') {
                $fail('Роботам вход воспрещен');
            }

        } catch (\Exception $e) {
            \Log::error('Captcha validation exception', [
                'message' => $e->getMessage()
            ]);
        }
    }
}
