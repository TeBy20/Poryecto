<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\cocheras;


class CocherasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        cocheras::factory()->count(100)->create();
    }
}
