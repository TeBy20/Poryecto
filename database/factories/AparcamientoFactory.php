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

        $vehiculoId = Vehiculo::inRandomOrder()->first()->id;

        $PorDefinirse = "Por definirse";

        return [
            'fecha_hora_entrada' => now()->toDateTimeString(), // Establece la hora actual
            'fecha_hora_salida' => $PorDefinirse, // Cambia esto según tus necesidades
            'id_vehiculo' => $vehiculoId,
            'monto_a_pagar' => $PorDefinirse, 
            'tiempo_estancia' => $PorDefinirse,
        ];
    }

}








