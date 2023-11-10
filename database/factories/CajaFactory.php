<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Caja;

class CajaFactory extends Factory
{
    protected $model = Caja::class;

    public function definition()
    {
        return [
            'motivos_accion' => $this->faker->sentence,
            'monto' => $this->faker->randomFloat(2, -1000, 1000),
            'fecha' => $this->faker->dateTime,
            'tipo' => $this->faker->randomElement(['ingreso', 'egreso']),
        ];
    }
}

