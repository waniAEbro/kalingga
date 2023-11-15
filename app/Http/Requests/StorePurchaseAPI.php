<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseAPI extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "purchase_date" => "required",
            "supplier_id" => "required",
            "due_date" => "required",
            "sale_production_id" => "required",
            "code" => "required",
            "method" => "required",
            "beneficiary_bank" => "required",
            "beneficiary_ac_usd" => "required",
            "bank_address" => "required",
            "swift_code" => "required",
            "beneficiary_name" => "required",
            "beneficiary_address" => "required",
            "phone" => "required",
            "location" => "required",
            "total_bill" => "required",
            "paid" => "required",
            "product_id" => "required",
            "quantity_purchase" => "required",
            "price_purchase" => "required"
        ];
    }
}
