<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = new Role();
        $role->nombre = 'admin';
        $role->descripcion = 'Administrador';
        $role->save();
        
        $role = new Role();
        $role->nombre = 'profesor';
        $role->descripcion = 'Profesor';
        $role->save();

        $role = new Role();
        $role->nombre = 'alumno';
        $role->descripcion = 'Alumno';
        $role->save();

        $role = new Role();
        $role->nombre = 'invitado';
        $role->descripcion = 'Invitado';
        $role->save();

    }
}
