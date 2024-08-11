<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Asignatura;

class AsignaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asig1 = Asignatura::create(['nombre' => 'Base de Datos']);
        $asig2 = Asignatura::create(['nombre' => 'Investigación de Operaciones I']);
        $asig3 = Asignatura::create(['nombre' => 'Matemática I']);
        $asig4 = Asignatura::create(['nombre' => 'Introducción a la ing. de sistemas']);
        $asig5 = Asignatura::create(['nombre' => 'Dibujo']);
        $asig6 = Asignatura::create(['nombre' => 'Metodología de la Investigación I']);
        $asig7 = Asignatura::create(['nombre' => 'Ingeniería de costos']);
        $asig8 = Asignatura::create(['nombre' => 'Topografía']);
        $asig9 = Asignatura::create(['nombre' => 'Concreto I']);
        $asig10 = Asignatura::create(['nombre' => 'Circuitos Eléctricos I']);
        $asig11 = Asignatura::create(['nombre' => 'Proceso de fabricación I']);
        $asig12 = Asignatura::create(['nombre' => 'Control de calidad']);

        $asig1->carreras()->attach([2]);
        $asig2->carreras()->attach([1, 2, 3, 4, 6, 7]);
        $asig3->carreras()->attach([1, 2, 3, 4, 5, 6, 7]);
        $asig4->carreras()->attach([2]);
        $asig6->carreras()->attach([1, 2, 3, 4, 5, 6, 7]);
        $asig7->carreras()->attach([7]);
        $asig8->carreras()->attach([3]);
        $asig9->carreras()->attach([3]);
        $asig10->carreras()->attach([4]);
        $asig11->carreras()->attach([6]);
        $asig12->carreras()->attach([6, 7]);
    }
}
