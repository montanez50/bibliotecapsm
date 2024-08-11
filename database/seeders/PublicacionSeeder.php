<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Publicacion;

class PublicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pub1 = Publicacion::create([
            'user_id' => '1', 
            'titulo' => 'Kendall y Kendall',
            'carrera_id' => '2',
            'anio' => '2024',
            'archivo' => 'archivos/libros/8KruEjPExmT2Y3zSV7rQ7Sd4qZwIU8iKgyMsR2Zr.pdf'
        ]);

        $pub1->autores()->attach([1, 2, 4]);
                            
        $pub2 = Publicacion::create([
            'user_id' => '1', 
            'titulo' => 'Ing de softwaare un enfoque práctico',
            'carrera_id' => '2',
            'anio' => '2024',
            'archivo' => 'archivos/libros/6dpi4g1dKchOV6Aw1z85gdzemjZIcZqRigWCPjWe.pdf'
        ]);
        
        $pub2->autores()->attach([5]);

        $pub3 = Publicacion::create([
            'user_id' => '1', 
            'titulo' => 'Libros de ing de sistemas',
            'carrera_id' => '2',
            'anio' => '2024',
            'archivo' => 'archivos/libros/6dpi4g1dKchOV6Aw1z85gdzemjZIcZqRigWCPjWe.pdf'
        ]);

        $pub3->autores()->attach([2, 3]);

        $pub3 = Publicacion::create([
            'user_id' => '1', 
            'titulo' => 'Libros de ing de civil',
            'carrera_id' => '3',
            'anio' => '2012',
            'archivo' => 'archivos/libros/6dpi4g1dKchOV6Aw1z85gdzemjZIcZqRigWCPjWe.pdf'
        ]);

        $pub3->autores()->attach([1]);

        $pub4 = Publicacion::create([
            'user_id' => '1', 
            'titulo' => 'Libros de ing de civil2',
            'carrera_id' => '3',
            'anio' => '2024',
            'archivo' => 'archivos/libros/6dpi4g1dKchOV6Aw1z85gdzemjZIcZqRigWCPjWe.pdf'
        ]);

        $pub4->autores()->attach([3, 4]);

    }
}
