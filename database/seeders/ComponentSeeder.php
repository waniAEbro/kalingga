<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Seeder;
use App\Models\ComponentProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Component::create(["name" => "kayu", "price_per_unit" => 1000, "unit" => "m"]);

        DB::table("component_product")->insert(["component_id" => 1, "product_id" => 1, "quantity" => 1]);
    }
}
