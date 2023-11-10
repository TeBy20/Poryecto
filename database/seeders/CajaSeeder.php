<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Caja;
use App\Models\CajaFactory;

class CajaSeeder extends Seeder
{
    public function run()
    {
        Caja::factory()->count(50)->create();
    }
}

