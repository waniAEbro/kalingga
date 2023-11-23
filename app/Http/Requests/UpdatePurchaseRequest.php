<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchaseRequest extends FormRequest
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
        if ($this->paid) {
            return [
                "paid" => "required",
            ];
        } else if ($this->delivered_product && $this->delivered_component) {
            return [
                "delivered_product.*" => "required",
                "remain_product.*" => "required",
                "total_product.*" => "required",
                "delivered_component.*" => "required",
                "remain_component.*" => "required",
                "total_component.*" => "required",
            ];
        } else if ($this->delivered_product) {
            return [
                "delivered_product.*" => "required",
                "remain_product.*" => "required",
            ];
        } else {
            return [
                "delivered_component.*" => "required",
                "remain_component.*" => "required",
            ];
        }
    }
}
