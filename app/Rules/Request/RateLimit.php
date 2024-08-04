<?php

namespace App\Rules\Request;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\RateLimiter;

class RateLimit implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $executed = RateLimiter::attempt(
            'login:' . $value,
            5,
            function () {
               return null;
            }
         );

        if (!$executed) {
            $fail('Excesso de tentativa de login, tente novamente mais tarde em 1 minuto');
        }

    }
}
