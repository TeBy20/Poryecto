<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aparcamiento;
use App\Models\Vehiculo;
use App\Models\Zonas;

class AparcamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aparcamiento::factory()
            ->count(10)
            ->create()
            ->each(function ($aparcamiento) {
                // Asignar vehículo aleatorio a un aparcamiento
                $vehiculo = Vehiculo::inRandomOrder()->first();
                $aparcamiento->id_vehiculo = $vehiculo->id;
                $aparcamiento->save();

            });
    }
}

