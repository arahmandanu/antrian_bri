<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class ValidLongitude implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if ($value < -180 || $value > 180) {
            return $fail('Longitude tidak sesuai');
        }
    }
}
