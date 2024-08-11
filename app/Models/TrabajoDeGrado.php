<?php

namespace App\Models;

use App\Models\LineaDeInvestigacion;
use Illuminate\Database\Eloquent\Model;

class TrabajoDeGrado extends Model 
{

    protected $table = 'trabajos_de_grado';

    public $timestamps = false;

    protected $fillable = array('publicacion_id',
                                'linea_de_investigacion_id',
                                'tutor',
                                'resumen', 
                                'descriptores', 
                                'mencion');

    public function publicaciones()
    {
        return $this->hasOne(Publicacion::class, 'id', 'publicacion_id');
    }

    public function lineas()
    {
        return $this->belongsTo(LineaDeInvestigacion::class, 'linea_de_investigacion_id');
    }

}