<?php

namespace Database\Seeders;

use App\Models\Vehiculo;
use Illuminate\Database\Seeder;
use App\Models\Categorias;


class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehiculo::factory()
            ->count(15)
            ->create([
                'categoria_id' => Categorias::inRandomOrder()->first()->id,
            ]);
    }
}
