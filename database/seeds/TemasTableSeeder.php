<?php

use App\Tema;
use Illuminate\Database\Seeder;

class TemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tema = new Tema();
        $tema->curso_id = 1;
        $tema->nombre = "Ecuaciones lineales";
        $tema->save();

        $tema = new Tema();
        $tema->curso_id = 1;
        $tema->nombre = "Ecuaciones diferenciales";
        $tema->save();
    }
}
