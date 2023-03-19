<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBankBranchRequest extends FormRequest
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
        $rule = [
            'area_code' => ['required', 'exists:bank_areas,code'],
            'code' => ['required'],
            'name' => ['required', 'max:255', 'min:10'],
        ];

        if ($this->input('code') != $this->bank_branch->code) {
            array_push($rule['code'], 'unique:bank_branches,code');
        }

        return $rule;
    }
}
