<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            ZonasSeeder::class,
        ]);

        $this->call([
            CategoriasSeeder::class,
        ]);

        $this->call([
            CargosSeeder::class,
        ]);

        $this->call([
            ServiciosSeeder::class,
        ]);

        $this->call([
            MediopagoSeeder::class,
        ]);
    }
}
