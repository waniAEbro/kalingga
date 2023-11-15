<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ComponentSupplier>
 */
class ComponentSupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "component_id" => fake()->numberBetween(1, 1000),
            "supplier_id" => 1,
            "price_per_unit" => fake()->numberBetween(1000, 100000)
        ];
    }
}
