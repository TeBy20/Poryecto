<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rol_admin = Role::create(['name' => 'admin']);
        $rol_playero = Role::create(['name' => 'playero']);

        // Permisos para cada Rol
    Permission::create(['name' => 'VISTA_ADMIN'])->assignRole($rol_admin);
    Permission::create(['name' => 'VISTA_PLAYERO'])->assignRole($rol_playero);
    //Permission::create(['name' => 'lista_pagos'])->syncRoles([$rol_vendedor,

    }
}
