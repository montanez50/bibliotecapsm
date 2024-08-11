<?php

namespace App\Models;

use App\Models\LineaDeInvestigacion;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model 
{

    protected $table = 'carreras';
    public $timestamps = false;
    protected $fillable = array('nombre');

    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class);
    }

    public function lineas()
    {
        return $this->hasMany(LineaDeInvestigacion::class);
    }

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class);
    }
}