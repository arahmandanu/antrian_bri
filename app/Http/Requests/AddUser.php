<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUser extends FormRequest
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
            'name' => ['required', 'min:4'],
            'email' => ['required', 'unique:users'],
            'password' => ['min:6', 'required'],
            'role' => ['required'],
            // 'unit_code' => ['required', 'exists:mst_bank,code'],
        ];

        return $rule;
    }
}
