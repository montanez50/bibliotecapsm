<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Editorial extends Model 
{

    protected $table = 'editoriales';
    public $timestamps = false;
    protected $fillable = ['nombre'];

}