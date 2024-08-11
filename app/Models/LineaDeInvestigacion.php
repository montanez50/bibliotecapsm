<?php

namespace App\Models;

use App\Models\Carrera;
use App\Models\TrabajoDeGrado;
use Illuminate\Database\Eloquent\Model;

class LineaDeInvestigacion extends Model 
{

    protected $table = 'lineas_de_investigacion';
    public $timestamps = false;
    protected $fillable = ['nombre',
                            'carrera_id'];

    public function carreras()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id', 'id');
    }

    public function trabajosDeGrado()
    {
        return $this->hasMany(TrabajoDeGrado::class);
    }

}