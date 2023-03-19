<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreButtonActorRequest extends FormRequest
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
            'code' => ['required', 'unique:button_actors,code'],
            'name' => ['required', 'min:6', 'max:50']
        ];
    }
}
