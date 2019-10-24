<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examene extends Model
{
    //
    public function user()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function pregunta(){
        return $this->hasMany(Pregunta::class);
    }
}
