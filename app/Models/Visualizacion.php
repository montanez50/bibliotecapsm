<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Visualizacion extends Model 
{

    protected $table = 'visualizaciones';
    protected $fillable = ['user_id', 'publicacion_id'];
    public $timestamps = true;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}