<?php

namespace App\Models;

use App\Models\Asignatura;
use App\Models\Publicacion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuiaAcademica extends Model
{
    use HasFactory;

    protected $table = 'guias_academicas';
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
