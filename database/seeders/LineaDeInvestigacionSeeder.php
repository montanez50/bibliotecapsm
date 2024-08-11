<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LineaDeInvestigacion;

class LineaDeInvestigacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LineaDeInvestigacion::create([
            'nombre' => 'Diseño Arquitectónico',
            'carrera_id' => '1'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Producción de Sistemas Constructivos',
            'carrera_id' => '1'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Diseño Urbano',
            'carrera_id' => '1'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Sistemas de procesamiento de información',
            'carrera_id' => '2'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Sistema y arquitectura de procesos',
            'carrera_id' => '2'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Domótica',
            'carrera_id' => '2'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Proyectos Civiles',
            'carrera_id' => '3'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Mantenimiento Preventivo Correctivo',
            'carrera_id' => '3'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Administración de obras',
            'carrera_id' => '3'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Diseño Electrónico',
            'carrera_id' => '4'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Biotecnología',
            'carrera_id' => '4'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Automatización y control',
            'carrera_id' => '4'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Diseño Eléctrico',
            'carrera_id' => '5'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Mantenimiento Eléctrico',
            'carrera_id' => '5'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Fuentes de energía',
            'carrera_id' => '5'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Proyectos Mecánicos',
            'carrera_id' => '6'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Materiales',
            'carrera_id' => '6'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Producción',
            'carrera_id' => '6'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Higiene y seguridad industrial',
            'carrera_id' => '7'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Gestión Gerencial',
            'carrera_id' => '7'
        ]);
        LineaDeInvestigacion::create([
            'nombre' => 'Mercado',
            'carrera_id' => '7'
        ]);

    }
}
