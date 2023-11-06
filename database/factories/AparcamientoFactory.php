<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehiculo;
use App\Models\Zonas;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aparcamiento>
 */
class AparcamientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {

        $zonasId = Zonas::inRandomOrder()->first()->id;

        return [
            'fecha_hora_entrada' => now()->toDateTimeString(), // Establece la hora actual
            'fecha_hora_salida' => now()->addHours(2), // Cambia esto según tus necesidades
            'estado' => 0, // Establece el estado inicial en 0
            'id_vehiculo' => Vehiculo::factory()->create()->id,
            'id_zona' => $zonasId,
        ];
    }

}








