<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitCodeRequest extends FormRequest
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
            'name' => ['required'],
        ];

        if ($this->code != $this->unit_code->code) {
            array_push($rule['code'], 'unique:unit_codes');
        }
        if ($this->name != $this->unit_code->name) {
            array_push($rule['name'], 'unique:unit_codes');
        }

        return $rule;
    }
}
