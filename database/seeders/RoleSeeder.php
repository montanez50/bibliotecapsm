<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Administrador'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'Estudiante']);
        Role::create(['name' => 'Docente'])->givePermissionTo(['manage videos',
                                                            'manage guias',
                                                            'reportes', 
                                                            'reportes visualización de documentos',
                                                            ]);
        Role::create(['name' => 'Personal Administrativo'])->givePermissionTo(['manage libros',
                                                                                'manage tdg',
                                                                                'manage proyectos',
                                                                                'manage users',
                                                                                'manage dbfields',
                                                                                'reportes',
                                                                                'reportes listado de usuarios',
                                                                                'reportes visualización de documentos', 
                                                                            ]);
    }
}
