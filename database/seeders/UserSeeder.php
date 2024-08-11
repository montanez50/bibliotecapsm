<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'cedula' => 'V27126124',
            'nombres' => 'Cristian Jesús Parra',
            'correo' => 'admin@admin.com',
            'password' => '12345678'
        ]);
        $user->assignRole('Administrador');
        
        $user = User::create([
            'cedula' => 'V12808881',
            'nombres' => 'Mildren J. Parra',
            'correo' => 'stud@stud.com',
            'password' => '12345678'
        ]);
        $user->assignRole('Docente');

        $user = User::create([
            'cedula' => 'V29857694',
            'nombres' => 'Diego Varguilla',
            'correo' => 'stud2@stud2.com',
            'password' => '12345678'
        ]);
        $user->assignRole('Estudiante');
    }
}
