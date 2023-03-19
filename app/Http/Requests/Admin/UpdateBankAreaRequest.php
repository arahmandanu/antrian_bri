<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBankAreaRequest extends FormRequest
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
            'code' => ['required'],
            'name' => ['required', 'max:255', 'min:10'],
        ];

        if ($this->input('code') != $this->bank_area->code) {
            array_push($rule['code'], 'unique:bank_areas,code');
        }

        return $rule;
    }

    public function messages()
    {
        return [
            'code.unique' => 'This code has already been taken',
        ];
    }
}
