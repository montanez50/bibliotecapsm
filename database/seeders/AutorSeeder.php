<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Autor;

class AutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Autor::create(['nombre' => 'Cristian Parra']);
        Autor::create(['nombre' => 'Yuly Rodríguez']);
        Autor::create(['nombre' => 'Juan Pérez']);
        Autor::create(['nombre' => 'Oriana Briñez']);
        Autor::create(['nombre' => 'Roger Pressman']);
    }
}
