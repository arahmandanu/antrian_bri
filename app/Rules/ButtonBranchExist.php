<?php

namespace App\Rules;

use App\Models\ButtonBranch;
use Illuminate\Contracts\Validation\Rule;

class ButtonBranchExist implements Rule
{
    public $bank_code;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($bank_code)
    {
        $this->bank_code = $bank_code;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ButtonBranch::where('bank_code', $this->bank_code)->where('actor_code', $value)->count() == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'User sudah memiliki button.';
    }
}
