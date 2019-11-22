<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    public function respuesta(){
        return $this->hasMany(Respuesta::class);
    }
}
