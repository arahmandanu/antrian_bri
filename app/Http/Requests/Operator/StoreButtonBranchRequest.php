<?php

namespace App\Http\Requests\Operator;

use App\Rules\ButtonBranchExist;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'button' => ['required'],
            'actor_code' => ['required', new ButtonBranchExist(auth()->user()->unit_code)]
        ];
    }
}
