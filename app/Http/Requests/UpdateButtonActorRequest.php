<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateButtonActorRequest extends FormRequest
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
            'name' => ['required', 'max:50', 'min:6'],
        ];

        if ($this->input('code') != $this->button_actor->code) {
            array_push($rule['code'], 'unique:button_actors,code');
        }
        return $rule;
    }
}
