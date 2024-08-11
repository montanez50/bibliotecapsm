<?php

namespace App\Models;

use App\Models\Video;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model 
{

    protected $table = 'asignaturas';
    public $timestamps = false;
    protected $fillable = ['nombre'];

    public function carreras()
    {
        return $this->belongsToMany(Carrera::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}