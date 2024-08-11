<?php

namespace App\Models;

use App\Models\Asignatura;
use Illuminate\Database\Eloquent\Model;

class Video extends Model 
{

    protected $table = 'videos';
    public $timestamps = false;
    protected $fillable = array('publicacion_id',
                                'descripcion', 
                                'asignatura_id');

    public function publicaciones()
    {
        return $this->hasOne(Publicacion::class, 'id', 'publicacion_id');
    }

    public function asignaturas()
    {
        return $this->hasOne(Asignatura::class, 'id', 'asignatura_id');
    }

}