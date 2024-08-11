<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model 
{

    protected $table = 'autores';
    public $timestamps = false;
    protected $fillable = array('nombre');

    public function publicaciones()
    {
        return $this->belongsToMany(Publicacion::class);
    }

}