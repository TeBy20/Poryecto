<?php

namespace Database\Seeders;

use App\Models\Zonas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Zonas::factory()
            ->count(10) // Crea solo 2 registros en la tabla Zonas
            ->create();
    }
}
