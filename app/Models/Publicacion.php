<?php

namespace App\Models;

use App\Models\Autor;
use App\Models\Video;
use App\Models\GuiaAcademica;
use App\Models\Visualizacion;
use App\Models\TrabajoDeGrado;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model 
{

    protected $table = 'publicaciones';
    public $timestamps = true;
    protected $fillable = [
        'user_id', 
        'titulo', 
        'carrera_id', 
        'anio', 
        'archivo'
    ];

    //muchos a uno
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    // muchos a uno
    public function carreras()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }

    //muchos a muchos
    public function autores()
    {
        return $this->belongsToMany(Autor::class);
    }

    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }

    public function tdg()
    {
        return $this->belongsTo(TrabajoDeGrado::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function guia()
    {
        return $this->belongsTo(GuiaAcademica::class);
    }

    public function visualizaciones()
    {
        return $this->belongsToMany(Visualizacion::class, 'visualizaciones');
    }
}