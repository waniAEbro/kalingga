<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pack;
use App\Models\ProductionCost;
use App\Models\OtherCost;
use App\Models\Product;
use App\Models\Production;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 1000; $i++) {
            // Simpan data ke tabel 'pack'
            $pack = Pack::create([
                "cost" => rand(50, 200),
                "outer_length" => rand(10, 50),
                "outer_width" => rand(5, 30),
                "outer_height" => rand(5, 30),
                "inner_length" => rand(5, 25),
                "inner_width" => rand(5, 25),
                "inner_height" => rand(5, 25),
                "nw" => rand(1, 10),
                "gw" => rand(10, 50),
                "box_price" => rand(5, 20),
                "box_hardware" => rand(1, 5),
                "assembling" => rand(1, 10),
                "stiker" => rand(1, 5),
                "hagtag" => rand(1, 5),
                "maintenance" => rand(5, 20),
                "total" => rand(50, 200),
            ]);

            // Simpan data ke tabel 'production_costs'
            $production_costs = ProductionCost::create([
                "total_production" => rand(100, 500),
                "price_perakitan" => rand(10, 50),
                "price_perakitan_prj" => rand(5, 25),
                "price_grendo" => rand(1, 10),
                "price_obat" => rand(1, 10),
                "upah" => rand(5, 20),
                "total" => rand(100, 500),
            ]);

            // Simpan data ke tabel 'other_costs'
            $other_costs = OtherCost::create([
                "biaya_overhead_pabrik" => rand(10, 50),
                "biaya_listrik" => rand(5, 20),
                "biaya_pajak" => rand(1, 5),
                "biaya_ekspor" => rand(5, 20),
                "total" => rand(20, 100),
            ]);

            // Simpan data ke tabel 'product'
            $product = Product::create([
                "name" => "Product Name $i",
                "code" => $this->generateUniqueCode(),
                "rfid" => $this->generateUniqueRfid(),
                "logo" => "logo$i.png",
                "pack_id" => $pack->id,
                "productioncosts_id" => $production_costs->id,
                "othercosts_id" => $other_costs->id,
                "length" => rand(1, 10),
                "width" => rand(1, 10),
                "height" => rand(1, 10),
                "sell_price" => rand(50, 200),
                "barcode" => "BARCODE$i",
                "hpp" => rand(20, 100),
                "sell_price_usd" => rand(50, 200),
                "cbm" => rand(1, 5),
            ]);

            // Simpan data ke tabel 'productions'
            Production::create([
                "product_id" => $product->id,
                "quantity_finished" => 0,
                "quantity_not_finished" => 0
            ]);

            // Loop untuk menyimpan data ke tabel 'component_product'
            for ($j = 1; $j <= rand(1, 5); $j++) {
                DB::table("component_product")->insert([
                    "product_id" => $product->id,
                    "component_id" => $j,
                    "quantity" => rand(1, 10)
                ]);
            }

            // Loop untuk menyimpan data ke tabel 'product_supplier'
            for ($k = 1; $k <= rand(1, 3); $k++) {
                DB::table("product_supplier")->insert([
                    "product_id" => $product->id,
                    "supplier_id" => $k,
                    "price_per_unit" => rand(10, 50)
                ]);
            }
        }
    }

    /**
     * Generate a unique code.
     *
     * @return string
     */
    private function generateUniqueCode()
    {
        $code = "CODE" . Str::random(3); // Ganti 3 dengan panjang yang sesuai
        return Product::where('code', $code)->exists() ? $this->generateUniqueCode() : $code;
    }

    /**
     * Generate a unique RFID.
     *
     * @return string
     */
    private function generateUniqueRfid()
    {
        $rfid = "RFID" . Str::random(3); // Ganti 3 dengan panjang yang sesuai
        return Product::where('rfid', $rfid)->exists() ? $this->generateUniqueRfid() : $rfid;
    }
}
