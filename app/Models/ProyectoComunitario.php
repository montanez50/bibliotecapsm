<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoComunitario extends Model 
{

    protected $table = 'proyectos_comunitarios';
    public $timestamps = false;
    protected $fillable = array('publicacion_id','tutor', 'descripcion');

    public function publicaciones()
    {
        return $this->hasOne(Publicacion::class, 'id', 'publicacion_id');
    }

}