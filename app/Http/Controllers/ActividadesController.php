<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Actividade;
use App\Examene;
use App\TipoActividad;
use App\Tema;
use App\Prgunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ActividadesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function eliminarActividad(Request $request,$idAct,$tipo,$idGen)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        {
            if($tipo=="Examen")
            {
                $curseDel = DB::table('actividades')->where('id', '=',$idAct)->delete();
                DB::table('examenes')->where('id', '=',$idGen)->delete();
            }
            
            return back();
        }
    }
    public function editarActividad(Request $request,$idAct,$idTipo,$idActGen)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        {
            $tipoActiv = TipoActividad::findOrFail($idTipo)->first();
            
           // dd($tipoActiv->tipo);
            if($tipoActiv->tipo=="Examen")
            {
                
              
                
                $nombreExam = Examene::findOrFail($idActGen)->where('id','=',$idActGen)->get()->first()->nombre;
                $idExamen = $idActGen;
                $actividad = Actividade::findOrFail($idAct)->where('id','=',$idAct)->get()->first();
               // dd($actividad);
              
                $curso = Curso::findOrFail($actividad->curso_id)->where('id','=',$actividad->curso_id)->get()->first()->nombre;
                
                $tema = Tema::findOrFail($actividad->curso_id)->where('id','=',$actividad->tema_id)->get()->first()->nombre;

                $examen = ['examen'=>$nombreExam,'idExamen'=>$idExamen,'curso'=>$curso,'tema'=>$tema];
                $preguntas = Examene::findOrFail($idActGen)->pregunta;
                //dd($preguntas);
               // $curso = E
               // dd($examen);
                return view('crearPregunta',compact('examen','preguntas'));
            }
            else{

            }
        }
    }
    public function actividad(Request $request)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        {
            //$tipoAct = $curso = Curso::findOrFail(1);
            $curso = DB::Table('actividades')
            ->join('tipo_actividads',"actividades.tipoActividad_id","=","tipo_actividads.id")
            ->where('actividades.curso_id',"=",1)
            ->select('actividades.id AS idAct','actividades.idGenerico','actividades.tipoActividad_id','tipo_actividads.tipo','actividades.curso_id')
            ->get();

            
            
            
            //$curso = Curso::findOrFail(1);
            $actividades = collect();
            //dd($curso);
            foreach ($curso as $act) {
                if($act->tipo=="Examen")
                {
                    $nombre = Examene::findOrFail($act->idGenerico)->nombre;
                    $actividades = $actividades
                    ->concat([['nombre' => $nombre,'tipo'=> $act->tipo,'id'=>$act->idAct,'curso_id' => $act->curso_id , 'id_tipo'=> $act->tipoActividad_id , 'id_act_gen'=>$act->idGenerico]]);
                }
                else if($act->tipo=="Tarea")
                {

                }
            }
            $actividades = $actividades->all();
           // dd($actividades->all());
           return view('actividad',compact('actividades'));
        }
    }
    public function crearActividad(Request $request)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        {
            switch($request->tipo)
            {
                case "examen":
                $actgeneric = new Examene();
                $actgeneric->nombre = $request->nombre;
                $actgeneric->descripcion = $request->descripcion;
                $actgeneric->save();
                $tipo = "examen";
                break;
                case "tarea":
                //Completar
                break;
            }
            $act = new Actividade();
            $act->curso_id = 1;
            $act->idGenerico = $actgeneric->id;
            $act->tema_id=1;
            $act->tipoActividad_id = 1;
            $act->save();

            return back();
        }
    }
    
    
    
}
