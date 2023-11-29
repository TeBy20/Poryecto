<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categorias>
 */
class CategoriasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombreCategoria = $this->faker->unique()->randomElement(['Motos', 'Autos']);

        return [
            'nombre_categoria' => $nombreCategoria,
            'tarifas' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
