<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;
    /**
         * The attributes that should be cast.
         *
         * @var array
         */
        protected $casts = [
            'created_at' => 'datetime:d-m-Y',
        ];

    public function imagen()
    {
        return $this->hasMany('App\Models\Imagen');
    }


    public function seccion()
    {
        return $this->belongsTo('App\Models\Seccion','seccion_id','id');
    }


}