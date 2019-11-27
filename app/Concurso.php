<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concurso extends Model
{
    //
    public function pregunta(){
        return $this->hasMany(Pregunta::class);
    }
}
