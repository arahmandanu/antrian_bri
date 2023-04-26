<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBankBranchesRequest extends FormRequest
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
            'area_code' => ['required', 'exists:bank_areas,code'],
            'code' => ['required', 'unique:bank_branches,code'],
            'name' => ['required', 'max:255', 'min:5'],
        ];
    }
}
