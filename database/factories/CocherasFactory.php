<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\cocheras>
 */
class CocherasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $numLugar = 1000; // Inicializa el número de lugar en 1000

        return [
            'num_lugar' => $numLugar++, // Utiliza el número actual y luego incrementa
            'piso' => ceil($numLugar / 100), // Calcula el piso en función del número de lugar
            'disponible' => true,
        ];
    }
}
