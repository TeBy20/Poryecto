<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categorias;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehiculo>
 */
class VehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $categoriaId = Categorias::inRandomOrder()->first()->id;

        return [
            'nombre_modelo' => fake()->unique()->word,
            'propietario' => fake()->name(),
            'categoria_id' => $categoriaId, //Fk de id de categorias
        ];
    }
}
