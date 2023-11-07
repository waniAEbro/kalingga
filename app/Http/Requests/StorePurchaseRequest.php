<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'supplier_id' => 'required',
            'purchase_date' => 'required',
            'due_date' => 'required',
            'code' => 'required',
            'paid' => 'required',
            "method" => "required",
            "beneficiary_bank" => "required",
            "beneficiary_ac_usd" => "required",
            "bank_address" => "required",
            "swift_code" => "required",
            "beneficiary_name" => "required",
            "beneficiary_address" => "required",
            "phone" => "required",
            "location" => "required",
            "total_bill" => 'required'
        ];
    }
}
