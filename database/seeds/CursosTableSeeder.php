<?php
use App\Curso;
use App\User;
use Illuminate\Database\Seeder;

class CursosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
 
        $curso = new Curso();
        $curso->nombre = 'Matemáticas';
        $curso->idProfesor = 2;
        $curso->save();

        $curso = new Curso();
        $curso->nombre = 'Química';
        $curso->idProfesor = 2;
        $curso->save();
        $curso = new Curso();
        $curso->nombre = 'Español';
        $curso->idProfesor = 2;
        $curso->save();

        $curso = new Curso();
        $curso->nombre = 'Inglés';
        $curso->idProfesor = 2;
        $curso->save();
        

    }
}
