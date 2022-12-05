<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;

    public function receta()
    {
        return $this->belongsTo('App\Models\Receta','receta_id','id');
    }
}
