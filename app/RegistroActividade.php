<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class RegistroActividade extends Model
{
    //
    static public function actividadRealizada($idAct,$idUser)
    {
        $existe =DB::table('registro_actividades')
        ->where('actividade_id', '=',$idAct)
        ->where('user_id', '=',$idUser)->exists();
       
        return $existe;
    }
}
