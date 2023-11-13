<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'component_id.*' => 'required',
            'quantity.*' => 'required',
            "supplier_id.*" => 'required',
            "price_supplier.*" => 'required',

            'name' => 'required',
            'code' => 'unique:products,code,' . $this->product->id . '|required',
            'rfid' => 'unique:products,rfid,' . $this->product->id . '|required',
            'logo' => 'required',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
            'sell_price' => 'required',
            'sell_price_usd' => "required",
            'barcode' => 'required',

            'pack_inner_length' => 'required',
            'pack_inner_height' => 'required',
            'pack_inner_width' => 'required',
            'pack_outer_length' => 'required',
            'pack_outer_height' => 'required',
            'pack_outer_width' => 'required',
            'pack_nw' => 'required',
            'pack_gw' => 'required',

            'price_perakitan' => 'required',
            'price_perakitan_prj' => 'required',
            'price_grendo' => 'required',
            'price_obat' => 'required',
            'upah' => 'required',

            'pack_box_price' => 'required',
            'pack_box_hardware' => 'required',
            'pack_assembling' => 'required',
            'pack_stiker' => 'required',
            'pack_hagtag' => 'required',
            'pack_maintenance' => 'required',

            'biaya_overhead_pabrik' => 'required',
            'biaya_listrik' => 'required',
            'biaya_pajak' => 'required',
            'biaya_ekspor' => 'required',
        ];
    }
}
