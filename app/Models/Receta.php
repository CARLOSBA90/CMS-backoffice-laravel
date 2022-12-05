<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;


    public function imagen()
    {
        return $this->hasMany('App\Models\Imagen');
    }


    public function seccion()
    {
        return $this->belongsTo('App\Models\Seccion','seccion_id','id');
    }
    
}