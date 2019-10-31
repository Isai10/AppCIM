<?php
namespace App\Http\Controllers;
use App\Curso;
use App\Actividade;
use App\Examene;
use App\TipoActividad;
use App\Tema;
use App\Pregunta;
use App\Respuesta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;




class ExamenController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function crearPreguntaRelleno(){
        if($request->user()->authorizeRoles([ 'profesor']))
        {

        }
    }
    public function crearPregunta(Request $request, $idExam)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        {

            if($request->tipo == "opcion_multiple")
            {
            $newPreg = new Pregunta();
            $newPreg->examene_id= $idExam;
            $newPreg->tipoPregunta = $request->tipo;
            $newPreg->pregunta= $request->pregunta;
            $newPreg->save();

            $resp = new Respuesta();
            $resp->pregunta_id = $newPreg->id;
            $resp->respuesta = $request->respuesta;
            $resp->VoF = true;
            $resp->save();
            return(\back());
            }
            else if ($request->tipo == "abierta")
            {
                $newPreg = new Pregunta();
                 $newPreg->examene_id= $idExam;
                    $newPreg->tipoPregunta = $request->tipo;
                 $newPreg->pregunta= $request->pregunta;
                 $newPreg->save();
                 return(\back());
            }
            else if ($request->tipo =="falso_verdadero")
            {
                $newPreg = new Pregunta();
                $newPreg->examene_id= $idExam;
                $newPreg->tipoPregunta = $request->tipo;
                $newPreg->pregunta= $request->pregunta;
                $newPreg->save();
    
                $resp = new Respuesta();
                $resp->pregunta_id = $newPreg->id;
                $resp->respuesta = $request->bool;
                $resp->VoF = true;
                $resp->save();
                return(\back());
            }
        }

    }
    public function eliminarPregunta(Request $request, $idPreg)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        {
            DB::table('preguntas')->where('id', '=',$idPreg)->delete();
            return(\back());
        }
    }
    public function examen(Request $request,$idExam)
    {
        if($request->user()->authorizeRoles([ 'profesor','alumno']))
        {
               
                $examen = Examene::findOrFail($idExam)->pregunta()->paginate(1);
                $nombreExamen =  Examene::findOrFail($idExam);
                if($examen->count()>0)
                {
                    return view('examen',compact('examen','nombreExamen'));
                }
                else{
                    back();
                }
        }
        else{
            \back();
        }
    }
}
