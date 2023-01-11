<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class ValidLatitude implements InvokableRule
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
        if ($value < -90 || $value > 90) {
            return $fail('Latitude tidak sesuai');
        }
    }
}
