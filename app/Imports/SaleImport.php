<?php

namespace App\Imports;

use App\Models\Pack;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Component;
use App\Models\OtherCost;
use App\Models\Production;
use App\Models\PaymentSale;
use Illuminate\Support\Str;
use App\Models\DeliverySale;
use App\Models\ProductionCost;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class SaleImport implements WithCalculatedFormulas, ToCollection, WithLimit
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $customer = "";
        foreach ($collection as $index => $row) {
            if ($index == 0) {
                $customerName = explode(" ", $row[0])[2];
                $customer = Customer::whereRaw("LOWER(name) = LOWER(?)", [$customerName])->first();
                if ($customer == null) {
                    $customer = Customer::create([
                        "name" => $customerName,
                        "email" => "",
                        "phone" => "",
                        "address" => "",
                        "code" => "",
                    ]);
                }
                continue;
            } else if ($index == 1 || $index == 2) {
                continue;
            } else if ($row[0] == null) {
                continue;
            } else {
                $kayu = Component::whereRaw("LOWER(name) = LOWER(?)", ["kayu a3"])->first();
                $product = Product::whereRaw("LOWER(code) = LOWER(?)", [$row[1] ?? 0])->first();
                if ($product) {
                    continue;
                } else {
                    $pack = Pack::create([
                        "inner_length" => $row[37] ?? 0,
                        "inner_width" => $row[38] ?? 0,
                        "inner_height" => $row[39] ?? 0,
                        "outer_length" => $row[40] ?? 0,
                        "outer_width" => $row[41] ?? 0,
                        "outer_height" => $row[42] ?? 0,
                        "nw" => floatval($row[44] ?? 0),
                        "gw" => floatval($row[45] ?? 0),
                        "box_price" => floatval($row[46] ?? 0) + floatval($row[47] ?? 0),
                        "box_hardware" => $row[49] ?? 0,
                        "assembling" => $row[50] ?? 0,
                        "stiker" => $row[51] ?? 0,
                        "hagtag" => $row[52] ?? 0,
                        "maintenance" => $row[53] ?? 0,
                        "total" => $row[54] ?? 0
                    ]);
                    $production_costs = ProductionCost::create([
                        "price_perakitan" => $row[30] ?? 0,
                        "price_perakitan_prj" => $row[31] ?? 0,
                        "price_grendo" => $row[32] ?? 0,
                        "price_obat" => $row[33] ?? 0,
                        "upah" => $row[34] ?? 0,
                        "total" => $row[35] ?? 0,
                    ]);
                    $other_costs = OtherCost::create([
                        "biaya_overhead_pabrik" => $row[56] ?? 0,
                        "biaya_listrik" => $row[57] ?? 0,
                        "biaya_pajak" => $row[58] ?? 0,
                        "biaya_ekspor" => $row[59] ?? 0,
                        "total" => $row[60] ?? 0,
                    ]);
                    do {
                        $uniqueCode = Str::random(10);
                    } while (Product::where('rfid', $uniqueCode)->exists());
                    $product = Product::create([
                        "name" => $row[4] ?? 0,
                        "code" => $row[1] ?? 0,
                        "rfid" => $uniqueCode,
                        "logo" => $row[9] ?? 0,
                        "pack_id" => $pack->id,
                        "productioncosts_id" => $production_costs->id,
                        "othercosts_id" => $other_costs->id,
                        "length" => floatval($row[5] ?? 0),
                        "width" => floatval($row[6] ?? 0),
                        "height" => floatval($row[7] ?? 0),
                        "sell_price" => floatval($row[12] ?? 0),
                        "barcode" => $row[10] ?? 0,
                        "hpp" => $row[13] ?? 0,
                        "sell_price_usd" => $row[11] ?? 0,
                    ]);
                    Production::create([
                        "product_id" => $product->id,
                        "quantity_finished" => 0,
                        "quantity_not_finished" => 0
                    ]);

                    DB::table("component_product")->insert([
                        "product_id" => $product->id,
                        "component_id" => $kayu->id,
                        "quantity" => $row[17] ?? 0
                    ]);
                }
            }
        }
    }

    public function limit(): int
    {
        return 250;
    }
}
