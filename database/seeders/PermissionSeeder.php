<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $admin = Role::create(['name' => 'Admin']);
        $qc = Role::create(['name' => 'QC']);
        $sales = Role::create(['name' => 'Sales']);

        $kalingga = \App\Models\User::factory()->create([
            'name' => 'Admin Kalingga',
            'email' => 'admin@kalingga.com',
            'password' => Hash::make("password"),
        ]);

        $kalingga->assignRole($admin);

        $qc_user = \App\Models\User::factory()->create([
            'name' => 'QC Kalingga',
            'email' => 'qc@kalingga.com',
            'password' => Hash::make("password"),
        ]);

        $qc_user->assignRole($qc);

        $sales_user = \App\Models\User::factory()->create([
            'name' => 'Sales Kalingga',
            'email' => 'sales@kalingga.com',
            'password' => Hash::make("password"),
        ]);

        $sales_user->assignRole($sales);
    }
}
