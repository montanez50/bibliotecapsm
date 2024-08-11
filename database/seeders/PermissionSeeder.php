<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            'name' => 'manage libros'
        ]);

        Permission::create([
            'name' => 'manage tdg'
        ]);

        Permission::create([
            'name' => 'manage proyectos'
        ]);

        Permission::create([
            'name' => 'manage videos'
        ]);

        Permission::create([
            'name' => 'manage guias'
        ]);

        Permission::create([
            'name' => 'manage users'
        ]);

        Permission::create([
            'name' => 'manage dbfields'
        ]);

        Permission::create([
            'name' => 'reportes'
        ]);

        Permission::create([
            'name' => 'reportes listado de usuarios'
        ]);

        Permission::create([
            'name' => 'reportes visualización de documentos'
        ]);

        Permission::create([
            'name' => 'backups'
        ]);
    }
}
