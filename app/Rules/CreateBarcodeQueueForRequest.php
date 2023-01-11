<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\InvokableRule;

class CreateBarcodeQueueForRequest implements InvokableRule
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
        $queueFor = Carbon::parse($value);
        if ($queueFor < now()->startOfDay()) {
            $fail('Tanggal Antrian harus lebih besar atau sama dengan hari ini.');
        }
    }
}
