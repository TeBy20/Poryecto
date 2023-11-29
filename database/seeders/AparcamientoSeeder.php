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
        Aparcamiento::factory()->count(4)->create();
    }
}

