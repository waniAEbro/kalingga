<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductionRequest extends FormRequest
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
        if ($this->cek == "on") {
            return [
                'quantity_finished' => 'required',
                'quantity_not_finished' => 'required',

                'code' => 'required',

                'supplier_id' => 'required',
                'purchase_date' => 'required',
                'due_date' => 'required',
                'purchase_code' => 'required',
                'total_bill' => 'required',
                'paid' => 'required',

                'method' => 'required',
                "beneficiary_bank" => 'required',
                "beneficiary_ac_usd" => 'required',
                "bank_address" => 'required',
                "swift_code" => 'required',
                "beneficiary_name" => 'required',
                "beneficiary_address" => 'required',
                "phone" => 'required',

                'location' => 'required',
                'quantity_purchase' => 'required'
            ];
        } else {
            return [
                'quantity_finished' => 'required',
                'quantity_not_finished' => 'required'
            ];
        }
    }
}
