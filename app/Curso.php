<?php

namespace App;
use App\Tema;
use App\Actividade;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    public function user()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    public function temas()
    {
        return $this->hasMany(Tema::class)->withTimestamps();
    }
    public function actividad()
    {
        return $this->hasMany(Actividade::class);
    }
}
