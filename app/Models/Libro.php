<?php

namespace App\Models;

use App\Models\Publicacion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Libro extends Model 
{

    protected $table = 'libros';
    public $timestamps = false;
    protected $fillable = [
        'publicacion_id',
        'dewey', 
        'ISBN',
        'editorial', 
        'edicion', 
        'ejemplares', 
        'estado',
        'asignatura_id',
        'editorial_id',
    ];

    public function publicaciones()
    {
        return $this->hasOne(Publicacion::class, 'id', 'publicacion_id');
    }

    public function asignaturas()
    {
        return $this->hasOne(Asignatura::class, 'id', 'asignatura_id');
    }

    public function editoriales()
    {
        return $this->hasOne(Editorial::class, 'id', 'editorial_id');
    }

    // public function scopeCarreras(Builder $query, $filtro)
    // {
    //   if(!empty($filtro))
    //   {
    //     return $query->join('libros as l', 'publicaciones.id', '=', 'l.publicacion_id')
    //       ->where('publicaciones.carrera_id', $filtro)
    //       ->select('*');
    //   }
    // }
}