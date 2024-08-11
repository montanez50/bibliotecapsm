<?php

namespace Database\Seeders;

use App\Models\Visualizacion;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VisualizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Visualizacion::create([
            'user_id' => 2, 
            'publicacion_id' => 2
        ]);

        Visualizacion::create([
            'user_id' => 2, 
            'publicacion_id' => 1
        ]);

        Visualizacion::create([
            'user_id' => 3, 
            'publicacion_id' => 1
        ]);

        Visualizacion::create([
            'user_id' => 2, 
            'publicacion_id' => 1
        ]);

        Visualizacion::create([
            'user_id' => 6, 
            'publicacion_id' => 1
        ]);

    }
}
