<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Zonas>
 */
class ZonasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_zona' => fake()->sentence(),
            'capacidad' => fake()->numberBetween(0,20),
            'piso_zona' => fake()->numberBetween(1,5),
        ];
    }
}
