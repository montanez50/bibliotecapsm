<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Libro;

class LibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Libro::create([
            'publicacion_id' => '1',
            'asignatura_id' => '1',
            'editorial_id' => mt_rand(1,4),
            'dewey' => '200.321',
            'ISBN' => '211212221',
            'edicion' => '9',
            'ejemplares' => '5',
            'estado' => 'Bueno'
        ]);

        Libro::create([
            'publicacion_id' => '2',
            'asignatura_id' => '3',
            'editorial_id' => mt_rand(1,4),
            'dewey' => '150',
            'ISBN' => '1919191919',
            'edicion' => '1',
            'ejemplares' => '2',
            'estado' => 'Deteriorado'
        ]);

        Libro::create([
            'publicacion_id' => '3',
            'asignatura_id' => '8',
            'editorial_id' => mt_rand(1,4),
            'dewey' => '602.12',
            'ISBN' => '211212678',
            'edicion' => '9',
            'ejemplares' => '5',
            'estado' => 'Bueno'
        ]);

        Libro::create([
            'publicacion_id' => '4',
            'asignatura_id' => '2',
            'editorial_id' => mt_rand(1,4),
            'dewey' => '602.12',
            'ISBN' => '911212678',
            'edicion' => '4',
            'ejemplares' => '1',
            'estado' => 'Deteriorado'
        ]);
    }
}
