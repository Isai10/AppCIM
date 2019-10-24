<?php
use App\TipoActividad;
use Illuminate\Database\Seeder;

class TiposActividadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tipo_act = new TipoActividad();
        $tipo_act->tipo= "Examen";
        $tipo_act->save();

        $tipo_act = new TipoActividad();
        $tipo_act->tipo= "Tarea";
        $tipo_act->save();

        $tipo_act = new TipoActividad();
        $tipo_act->tipo= "Concurso";
        $tipo_act->save();

    }
}
