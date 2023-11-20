<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            DB::table('suppliers')->insert([
                'name' => "name $i",
                'email' => "lala$i@gmail.com",
                'phone' => rand(2020, 202020),
                'address' => "alamat $i",
                'code' => rand(234, 23423),
                // Tambahkan kolom lain sesuai kebutuhan
            ]);
        }
    }
}
