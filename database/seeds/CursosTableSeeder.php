<?php
use App\Curso;
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
        $curso->nombre = 'matematicas';
        $curso->idProfesor = 1;
        $curso->save();

        $curso = new Curso();
        $curso->nombre = 'quimica';
        $curso->idProfesor = 1;
        $curso->save();
        
        $curso = new Curso();
        $curso->nombre = 'español';
        $curso->idProfesor = 1;
        $curso->save();

        $curso = new Curso();
        $curso->nombre = 'ingles';
        $curso->idProfesor = 1;
        $curso->save();
        

    }
}
