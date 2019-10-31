<?php

namespace App;
use App\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    public function curso()
    {
        return $this->belongsToMany(Curso::class,'curso_user')->withPivot('user_id','curso_id')->withTimestamps();
    }
    
    public function getCursos()
    {
        return $this->curso()->get();
    }
    public function authorizeRoles($roles)
    {
        if($this->hasAnyRole($roles))
        {
           return true;
        }
        else
        {
            return false;
        }
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
               if ($this->hasRole($role)) {
                  return true;
              }
        }
    } else {
        if ($this->hasRole($roles)) {
             return true; 
        }   
    }
    return false;
}
public function getRole()
{
    $roles = ['alumno','profesor','invitado'];
    foreach ($roles as $role) {
        # code...
        $rol = $this->roles()->where('nombre', $role)->first();
        if($rol)
        {
            return $rol;
        }
            
    }
    return false;
}
public function hasRole($role)
{
    if ($this->roles()->where('nombre', $role)->first()) {
        return true;
    }
    return false;
}
public function hasThisCurso($idcurso)
{
    if($this->curso()->where('curso_id',$idcurso)->first())
    {
        return true;
    }
    else {
        return false;
    }
}
}
