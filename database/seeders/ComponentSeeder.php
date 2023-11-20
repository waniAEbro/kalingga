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
        for ($i = 1; $i <= 50; $i++) {
            DB::table('components')->insert([
                'name' => "Component $i",
                'price_per_unit' => rand(1000, 90000),
                'unit' => 'm'
                // Tambahkan kolom lain sesuai kebutuhan
            ]);
        }
    }
}
