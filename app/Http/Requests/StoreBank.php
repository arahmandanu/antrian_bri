<?php

namespace App\Http\Requests;

use App\Rules\ValidLatitude;
use App\Rules\ValidLongitude;
use Illuminate\Foundation\Http\FormRequest;

class StoreBank extends FormRequest
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
            'code' => ['required', 'max:100', 'unique:mst_bank'],
            'name' => ['required', 'max:100', 'unique:mst_bank'],
            'address' => ['required', 'max:255'],
            'latitude' => [new ValidLatitude],
            'longitude' => [new ValidLongitude],
            'city' => ['required']
        ];
    }
}
