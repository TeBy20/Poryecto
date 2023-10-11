<?php

namespace Database\Seeders;

use App\Models\Mediopago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediopagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mediopago::factory(4)->create();
    }
}
