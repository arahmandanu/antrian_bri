<?php

namespace App\Http\Requests;

use App\Rules\BankIsExist;
use App\Rules\CreateBarcodeQueueForRequest;
use App\Rules\UnitCodeIsExist;
use Illuminate\Foundation\Http\FormRequest;

class GetBarcodeRequest extends FormRequest
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
            'unit_code' => ['required', new UnitCodeIsExist],
            'queue_for' => ['required', new CreateBarcodeQueueForRequest],
            'bank' => ['required', new BankIsExist],
            'transaction_params_id' => ['string', 'nullable'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'unit_code.required' => 'Unit wajib di isi',
            'queue_for.required' => 'Tanggal antrian wajib di isi',
        ];
    }
}
