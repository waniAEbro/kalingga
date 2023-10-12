<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\component>
 */
class ComponentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "unit" => fake()->randomLetter(),
            "price_per_unit" => fake()->numberBetween(1000, 10000000),
            "supplier_id" => fake()->numberBetween(1, 25)
        ];
    }
}
