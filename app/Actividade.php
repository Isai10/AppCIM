<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividade extends Model
{
   public function tipo()
    {
        return $this->hasOne('App\TipoActividad')->withTimestamps();


    }

    
}
