<?php

namespace App\Http\Controllers;
use App\User;
use App\Curso;
use App\Actividade;
use App\Examene;
use App\TipoActividad;
use App\RegistroActividade;
use App\Tema;
use App\Prgunta;
use App\Tarea;
use Carbon\Carbon;
use App\Concurso;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
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
    public function editarExamen(Request $request,$idAct,$idTipo,$idActGen)
    {
                $examen= Examene::findOrFail($idActGen);
                $actividad= Actividade::findOrFail($idAct);
                return view('editarExamen',compact('examen','actividad'));
    }

    public function editarActividad(Request $request,$idAct,$idTipo,$idActGen)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        {
            
            $tipoActiv = TipoActividad::findOrFail($idTipo);
          //  dd($tipoActiv);
            
            if($tipoActiv->tipo=="Examen")
            {
                $tipo = $tipoActiv->tipo;
                $nombreExam = Examene::findOrFail($idActGen)->where('id','=',$idActGen)->get()->first()->nombre;
                $idExamen = $idActGen;
                $actividad = Actividade::findOrFail($idAct)->where('id','=',$idAct)->get()->first();
                $curso = Curso::findOrFail($actividad->curso_id)->where('id','=',$actividad->curso_id)->get()->first()->nombre;
               // dd($actividad->tema_id);
                $tema = Tema::findOrFail($actividad->tema_id)->where('id','=',$actividad->tema_id)->get()->first()->nombre;
                
                $inicio = Carbon::createFromFormat('Y-m-d H:i:s', $actividad->inicio);
                $final =  Carbon::createFromFormat('Y-m-d H:i:s', $actividad->fin);
                $dias = $inicio->diffInDays($final);
                $horas = $inicio->diffInHours($final);
                $minutos = $inicio->diffInMinutes($final);
                if($dias=='0')
                {
                    $duracion= $horas." horas " .$minutos ." minutos" ;
                }
                if($dias == '0' && $horas =='0')
                {
                    $duracion= $minutos ." minutos" ;
                }
                if($dias == '0' && $horas =='0' && $minutos =='0')
                {
                   $duracion= $minutos ." minutos" ;
                } 
                if($dias != '0' && $horas !='0' && $minutos !='0')
                {
                   $duracion= $dias .' dias '. $horas." horas " .$minutos ." minutos" ;
                }
                //dd($duracion);
               // $dtOttawa->diffInHours($dtVancouver);  
                $examen = ['examen'=>$nombreExam,'idExamen'=>$idExamen,'curso'=>$curso,'tema'=>$tema,'duracion'=>$duracion];
               
                $preguntas = Examene::findOrFail($idActGen)->pregunta;
                //dd($preguntas);
               // $curso = E
               // dd($examen);
                return view('crearPregunta',compact('examen','preguntas','tipo','actividad'));
            }
            else if ($tipoActiv->tipo=="Tarea"){
                $tarea= Tarea::findOrFail($idActGen);
                $actividad= Actividade::findOrFail($idAct);
                return view('editarTarea',compact('tarea','actividad'));
            }
            else if ($tipoActiv->tipo=="Concurso")
            {
                
               
            }
        }
    }
    public function Diferencia($inicio,$fin)
    {

    }
    public function actividad(Request $request,$idCurso,$idUser)
    {
        
        if($request->user()->authorizeRoles([ 'profesor','alumno']))
        {
           
            //$tipoAct = $curso = Curso::findOrFail(1);
           // dd('hola');
           session()->put("id_Curso",$idCurso);
            $dataUser=session()->get("dataUser");
            Arr::set($dataUser,"id_curso",$idCurso);
            session()->put("dataUser",$dataUser); 
            $curso = DB::Table('actividades')
            ->join('tipo_actividads',"actividades.tipoActividad_id","=","tipo_actividads.id")
            ->where('actividades.curso_id',"=",$idCurso)
            ->select('actividades.id AS idAct','actividades.idGenerico','actividades.tipoActividad_id','tipo_actividads.tipo','actividades.curso_id')
            ->get();

            
            
            $rol =  User::findOrFail($idUser)->getRole();
           // dd($rol);
            $user = User::findOrFail($idUser);
            //$curso = Curso::findOrFail(1);
            $actividades = collect();
            //dd($curso);
            foreach ($curso as $act) {
                if($act->tipo=="Examen")
                {
                    $nombre = Examene::findOrFail($act->idGenerico)->nombre;
                }
                else if($act->tipo=="Tarea")
                {
                    $nombre = Tarea::findOrFail($act->idGenerico)->nombre;
                }
                elseif ($act->tipo=="Concurso") {
                    $nombre = Concurso::findOrFail($act->idGenerico)->nombre;
                }
               // dd($curso);
                $actRealizada = RegistroActividade::actividadRealizada($act->idAct,$idUser);
                $actividades = $actividades
                    ->concat([['nombre' => $nombre,'tipo'=> $act->tipo,'id'=>$act->idAct,'curso_id' => $act->curso_id , 'id_tipo'=> $act->tipoActividad_id , 'id_act_gen'=>$act->idGenerico,'realizada'=> $actRealizada]]);
            }
           
            $actividades = $actividades->all();
           // dd($actividades->all());
           return view('actividad',compact('actividades','rol','idCurso'));
        }
    }
    public function crearActividad(Request $request,$idCurso)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        { //dd($request->tipo);
            switch($request->tipo)
            {
                case "examen":
                    $actgeneric = new Examene();
                    $actgeneric->nombre = $request->nombre;
                    $actgeneric->descripcion = $request->descripcion;
                    $actgeneric->tipo=$request->tipo_exam;
                    $actgeneric->save();
                    $tipo = "examen";
                    $idTipoAct = 1;
                    $inicio =Carbon::createFromFormat('Y-m-d H:i:s', (String)($request->fecha. $request->hora_inicio));
                    $fin = Carbon::createFromFormat('Y-m-d H:i:s', (String)($request->fecha. $request->hora_fin));
                break;
               
                
                case "tarea":
                    
                    $actgeneric = new Tarea();
                    $actgeneric->nombre = $request->nombre;
                    $actgeneric->descripcion = $request->descripcion;
                    $actgeneric->save();
                    
                    $tipo = "tarea";
                    $idTipoAct = 2;
                    $inicio = Carbon::now()->format('Y-m-d H:i:s');
                   // dd($request->hora_fin);
                    $fin = Carbon::createFromFormat('Y-m-d H:i:s', (String)($request->fecha. $request->hora_fin));
                   
                //Completar
                break;
            }
            $act = new Actividade();
            $act->curso_id = $idCurso;
            $act->idGenerico = $actgeneric->id;
            $act->tema_id=1;
            $act->tipoActividad_id = $idTipoAct;
            $act->inicio = $inicio;
            $act->fin = $fin;
            $act->status= "ACTIVA";
            $act->save();
            

            return back();
        }
    }
    
    
    
}
