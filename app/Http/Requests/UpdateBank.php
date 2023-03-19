<?php

namespace App\Http\Requests;

use App\Rules\ValidLatitude;
use App\Rules\ValidLongitude;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBank extends FormRequest
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
            'KC_Code' => ['required', 'exists:bank_branches,code'],
            'code' => ['required', 'max:100'],
            'name' => ['required', 'max:100'],
            'address' => ['required', 'max:255'],
            'latitude' => [new ValidLatitude],
            'longitude' => [new ValidLongitude],
        ];

        if ($this->code != $this->bank->code) {
            array_push($rule['code'], 'unique:mst_bank');
        }

        if ($this->name != $this->bank->name) {
            array_push($rule['name'], 'unique:mst_bank');
        }

        return $rule;
    }
}
