<?php

namespace Database\Factories;

use App\Models\Mediopago;
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

        $vehiculo = Vehiculo::inRandomOrder()->first();
        $mediopago = Mediopago::inRandomOrder()->first();

        return [
            'categoria_id' => $vehiculo->categoria_id,
            'placa_vehiculo' => $vehiculo->placa_vehiculo,
            'codigo' => $vehiculo->codigo,
            'fecha_salida' => $this->faker->date,
            'hora_salida' => $this->faker->time,
            'fecha_entrada' => $this->faker->date,
            'hora_entrada' => $this->faker->time,
            'nombre_mediopago' => $mediopago->nombre_mediopago,
            'tiempo_estancia' => $this->faker->numberBetween(1, 300),
            'monto_total' =>  $this->faker->randomFloat(2, 10, 100),
        ];
    }

}








