<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso_user extends Model
{
    //
    public function user()
    {
        return $this->hasOne(App::User);
    }
    public function curso()
    {
        return $this->hasOne(App::Curso);
    }
}
