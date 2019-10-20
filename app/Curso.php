<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    public function user()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
