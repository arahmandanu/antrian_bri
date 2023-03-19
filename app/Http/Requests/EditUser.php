<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUser extends FormRequest
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
            'email' => ['required', 'min:4'],
        ];

        if ($this->email != $this->user->email) {
            array_push($rule['email'], 'unique:users');
        }

        if (isset($this->password)) {
            $rule['password'] = ['min:6'];
        }

        if ($this->input('role') != $this->user->roles->first()->id) {
            $rule['role'] = ['exists:roles,id'];
        }

        return $rule;
    }
}
