<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ComponentSupplier;
use App\Models\User;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Component;
use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ComponentSeeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Supplier::factory(1000)->create();
        Customer::factory(1000)->create();
        Component::factory(1000)->create();
        ComponentSupplier::factory(1000)->create();

        Employee::create([
            "employee_name" => "Imam",
            "rfid" => "AB0000000000000000000080"
        ]);

        Presence::create([
            "employee_id" => 1,
            "tag" => "AB0000000000000000000080",
            "in" => true,
            "out" => false,
        ]);

        $this->call([
            PermissionSeeder::class,
            // ComponentSeeder::class, 
            // SupplierSeeder::class, 
            // ProductSeeder::class
        ]);
    }
}
