<?php

namespace App\Http\Requests\Operator;

use App\Rules\ButtonBranchExist;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class StoreButtonBranchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'button' => ['required', ValidationRule::unique('button_branch')->where(fn (Builder $query) => $query->where('button', $this->button)->where('bank_code', auth()->user()->unit_code))],
            'actor_code' => ['required', new ButtonBranchExist(auth()->user()->unit_code)],
        ];
    }
}
