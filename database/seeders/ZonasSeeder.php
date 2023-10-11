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
        Zonas::factory(3)->create();
    }
}
