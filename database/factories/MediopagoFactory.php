<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mediopago>
 */
class MediopagoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $nombreMediopago = $this->faker->unique()->randomElement(['Efectivo', 'Credito', 'transferencia']);

        return [
            'nombre_mediopago' => $nombreMediopago,
        ];

    }
}
