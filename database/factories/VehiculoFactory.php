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

        $categoria = Categorias::inRandomOrder()->first();

        // Obtener fecha y hora actuales
        $fechaEntrada = now()->format('Y-m-d');
        $horaEntrada = now()->toTimeString();

        return [
            'placa_vehiculo' => $this->faker->unique()->word,
            'categoria_id' => $categoria->id,
            'fecha_entrada' => $fechaEntrada,
            'hora_entrada' => $horaEntrada,
        ];
    }
}

