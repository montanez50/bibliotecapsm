<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Carrera;

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Carrera::create(['nombre' => 'Arquitectura']);
        Carrera::create(['nombre' => 'Ingeniería de sistemas']);
        Carrera::create(['nombre' => 'Ingeniería civil']);
        Carrera::create(['nombre' => 'Ingeniería electrónica']);
        Carrera::create(['nombre' => 'Ingeniería eléctrica']);
        Carrera::create(['nombre' => 'Ingeniería de mto. mecánico']);
        Carrera::create(['nombre' => 'Ingeniería industrial']);
    }
}
