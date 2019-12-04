<?php
namespace App\Http\Controllers;
use App\Curso;
use App\Actividade;
use App\Examene;
use App\TipoActividad;
use App\Tema;
use App\Pregunta;
use App\Respuesta;
use App\RespuestasAlumno;
use App\RegistroActividade;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use Carbon\Carbon;

class ExamenController extends Controller
{
    //
    public function __construct()
    {
        
        $this->middleware('auth');
    }
    public function examenRedirect(Request $request)
    {
        if($request->user()->authorizeRoles([ 'profesor','alumno']))
        {
            return redirect($request->url);
        }
    }
    public function modificarExamen(Request $request,$idAct,$idGen)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        {
            DB::table('examenes')->where('id', '=',$idGen)->update(['nombre'=>$request->nombre,'descripcion'=>$request->descripcion]);
            
            if(strlen($request->hora_fin)==6)
            {
                $fin = Carbon::createFromFormat('Y-m-d H:i:s', (String)($request->fecha. $request->hora_fin.':00'));
            }else{
                

                $fin = Carbon::createFromFormat('Y-m-d H:i', (String)($request->fecha. $request->hora_fin));
               // dd($request->fecha)   ;             

            }
            
            if(strlen($request->hora_inicio)==6)
            {
                $inicio = Carbon::createFromFormat('Y-m-d H:i:s', (String)($request->fecha. $request->hora_inicio.':00'));
            }else{
                $inicio = Carbon::createFromFormat('Y-m-d H:i', (String)($request->fecha. $request->hora_inicio));
            }
                
            DB::table('actividades')->where('id', '=',$idAct)->update(['fin'=>$fin]);
            DB::table('actividades')->where('id', '=',$idAct)->update(['inicio'=>$inicio]);
            $dataUser = session()->get("dataUser");
            
            return redirect()->action('ActividadesController@actividad', [$dataUser['id_curso'],$dataUser['id_user']]);
        }
    }
    public function saveRespuestas(Request $request)
    {
        if($request->user()->authorizeRoles([ 'profesor','alumno']))
        {
            $respuestas = session()->get("respuestas");
            $dataUser = session()->get("dataUser");
            $examen = Examene::findOrfail($dataUser['id_exam']);
            $preguntas = $examen->pregunta()->get();
          //  dd($respuestas);
            if($examen->tipo=="Normal")
            {
                foreach ($preguntas as $preg) {
                    // dd($preg->examene_id);
                    $resp_alumno = new RespuestasAlumno();
                    $resp_alumno->user_id = $dataUser['id_user'];
                    $resp_alumno->pregunta_id = $preg->id;
                    $resp_alumno->examene_id = $preg->examene_id;
                    $resp_alumno->respuesta = $respuestas[$preg->id];
                    $resp_alumno->VoF = null;
                    $resp_alumno->saveOrFail();  
                 }
            }
           
           $reg_activ = new RegistroActividade();
              $reg_activ->user_id = $dataUser['id_user'];
              $reg_activ->actividade_id = $dataUser['id_act'];
              $reg_activ->estado = "REALIZADA";
              $reg_activ->saveOrFail();
              if($examen->tipo=="Normal")
              {
                return redirect()->action('ActividadesController@actividad', [$dataUser['id_curso'],$dataUser['id_user']]);
              }
              else{
                  $winers = session()->get('ganadores');
                  $puntos = session()->get('puntos');
                  $ganador = session()->get('ganador');
                  $ganadores_id = session()->get('ganadores_id');
                  $alumnos = Curso::findOrFail($dataUser['id_curso'])->User()->get();
                 // dd($alumnos);
                return \view('resultados',compact('winers','puntos','ganador','ganadores_id','alumnos'));
              }
        }
    }
    public function enviarExamen(Request $request)
    {
        if($request->user()->authorizeRoles([ 'profesor','alumno']))
        {
            $examen =  Examene::findOrFail(session()->get("dataUser")['id_exam']);
            $nombreExam = $examen->nombre;
            if($examen->tipo=="Normal")
            {
                //dd($nombreExam);
                return view('enviarExamen',compact('nombreExam'));
            }
            else{
                

                $resps = session()->get('respuestas');
                $pregTotal= $examen->pregunta->count();
                for($i = 0;$i<$pregTotal;$i++)
                {
                    $idstr = $examen->pregunta[$i]->id; 
                    $winers = Arr::set($winers,$idstr,'sg');
                    $pts = Arr::set($pts,$idstr,0);
                }
                for($i = 0;$i<$pregTotal;$i++)
                {
                    $idstr = $examen->pregunta[$i]->id; 
                    $answers = DB::table('respuestas_alumnos')->where('examene_id',$examen->id)->where('pregunta_id',$idstr)->get();
                 //   dd($answers);
                    if($answers!=null)
                    {
                        $answer = DB::table('respuestas')->where('pregunta_id',$idstr)->where('VoF',true)->get();
                      //  dd($answer);
                        for($t=0;$t<count($answers);$t++)
                        {

                            if($answers[$t]->respuesta == $answer[0]->id)
                            {
                                $winers = Arr::set($winers,$idstr,$answers[$t]->user_id);
                                $pts = Arr::set($pts,$answers[$t]->user_id,Pregunta::findOrFail($idstr)->valor);
                                break;
                            }
                        }
                    }
                }
               // dd($winers);
                $curso = Curso::findOrFail(session()->get('dataUser')['id_curso']);
                $alumnos = $curso->User()->get();
                $ganadores = collect();
                foreach ($alumnos as $al) {
                   $winers_final= Arr::set($winers_final,$al->id,0);
                   $id_winers = Arr::set($id_winers,$al->id,0);
                   $winers_pts = Arr::set($winers_pts,$al->id,0);
                   foreach ($winers as $win) {
                       if($win==$al->id)
                       {
                         //  dd("hola".$al->id.$winers_final[$al->id]);
                            $id_winers[$al->id]=$al->id;
                            $winers_final[$al->id]++;
                            $winers_pts[$al->id]+= Arr::pull($pts, $al->id);
                       }
                   }
                }
               
                $winers_final=Arr::sort($winers_final);
              //  dd($winers_final);
                $winers_pts=Arr::sort($winers_pts);
                

                foreach ($alumnos as $al) {
                    if($winers_final[$al->id]==last($winers_final)){
                        session()->put('ganador',$al);
                        break;
                    }
                }
                
                foreach ($alumnos as $al) {
                    if($winers_final[$al->id]==last($winers_final)){
                        $winer_id =   Arr::set($winer_id,$al->id,$al->id);
                    }
                }
               // dd($winers);
                $winer_id = Arr::sort($winer_id);
                $winer_id= array_reverse($winer_id);
                session()->put('ganadores_id',$winer_id);
                //$winers_final= array_reverse($winers_final);
                session()->put('ganadores',$winers_final);
                //$winers_pts= array_reverse($winers_pts);
                session()->put('puntos',$winers_pts);

                return redirect()->action('ExamenController@saveRespuestas');
               
                
            }
            
        }
    }
    public function preStepExamen(Request $request,$idExam,$idAct,$idTipo)
    {

        if($request->user()->authorizeRoles([ 'profesor','alumno']))
        {

            $dataUser=session()->get("dataUser");
            Arr::set($dataUser,"id_act",$idAct);
            Arr::set($dataUser,"id_tipoAct",$idTipo);
            Arr::set($dataUser,"id_exam",$idExam);
            session()->put("dataUser",$dataUser); 

            $examen = Examene::findOrFail($idExam);
            $pregTotal= $examen->pregunta->count();

            
            for($i = 0;$i<$pregTotal;$i++)
            {
                $idstr = $examen->pregunta[$i]->id; 
                if($i==0)
                {
                    Arr::set($resps,$idstr,'sc'); //Inicializa un array donde se vana a almacenar respuestas temporales del examen
                    Arr::set($time_inicio,$idstr,'st'); //Inicializa un array donde se vana a almacenar los tiempos de inicio de contestar cada pregunta
                    Arr::set($time_answer,$idstr,'st');//Inicializa un array donde se vana a almacenar el tiempo exacto de contestacion de cada pregunta
                }
                $resps = Arr::set($resps,$idstr,'sc');
                $time_inicio = Arr::set($time_inicio,$idstr,'st');
                $time_answer = Arr::set($time_answer,$idstr,'st');;
            }
           // dd($resps);
            session()->put('respuestas',$resps); //Almacena las respuesatas temporales en la session
            session()->put('time_inicio',$time_inicio); //Almacena las tiempos de inicio de pregunta temporales en la session
            session()->put('time_answer',$time_answer);//Almacena las tiempos de contestacion de pregunta temporales en la session

            $actividad = Actividade::findOrFail($idAct);
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
            return view('comenzarExamen',compact('examen','duracion','inicio', 'minutos'));
        }
    }
    public function saveRespTemp(Request $request,$idPreg,$tipo)
    {
        if($request->user()->authorizeRoles([ 'profesor','alumno']))
        {
            
            $resps = session()->get('respuestas');
            $time_answer = session()->get('time_answer');

            if($request->has('idResp'))
            {
                $resps[$idPreg] = (int)$request->idResp;
                $time_answer[$idPreg]= Carbon::now();
                if($tipo=="Concurso")
                {
                    $dataUser = session()->get("dataUser");
                    //$existe = !DB::table('respuestas_alumnos')->where('user_id', $dataUser['id_user'])->where('pregunta_id',$idPreg)->exists();
                   // if (!$existe) {
                        $resp_alumno = new RespuestasAlumno();
                        $resp_alumno->user_id = $dataUser['id_user'];
                        $resp_alumno->pregunta_id = $idPreg;
                        $resp_alumno->examene_id = $dataUser['id_exam'];
                        $resp_alumno->respuesta = $resps[$idPreg];
                        $resp_alumno->VoF = null;
                        $resp_alumno->saveOrFail();  
                    //}
                    
                    
                }
            }
            else if($request->has('resp'))
            {
                if($request->resp!= null)
                {
                    $resps[$idPreg] = $request->resp;
                    $time_answer[$idPreg]= Carbon::now(); 
                    if($tipo=="Concurso")
                    {
                        $dataUser = session()->get("dataUser");
                        //$existe = !DB::table('respuestas_alumnos')->where('user_id', $dataUser['id_user'])->where('pregunta_id',$idPreg)->exists();
                        // if (!$existe) {
                        $resp_alumno = new RespuestasAlumno();
                        $resp_alumno->user_id = $dataUser['id_user'];
                        $resp_alumno->pregunta_id = $idPreg;
                        $resp_alumno->examene_id = $dataUser['id_exam'];
                        $resp_alumno->respuesta = $resps[$idPreg];
                        $resp_alumno->VoF = null;
                        $resp_alumno->saveOrFail();  
                    //}
                    
                    
                    }
                }
                else {
                    $resps[$idPreg] = "sc";
                    if($tipo=="Concurso")
                    {
                        $dataUser = session()->get("dataUser");
                        //$existe = !DB::table('respuestas_alumnos')->where('user_id', $dataUser['id_user'])->where('pregunta_id',$idPreg)->exists();
                        // if (!$existe) {
                        $resp_alumno = new RespuestasAlumno();
                        $resp_alumno->user_id = $dataUser['id_user'];
                        $resp_alumno->pregunta_id = $idPreg;
                        $resp_alumno->examene_id = $dataUser['id_exam'];
                        $resp_alumno->respuesta = $resps[$idPreg];
                        $resp_alumno->VoF = null;
                        $resp_alumno->saveOrFail();  
                    //}
                    
                    
                    }
                }
               // dd($request->resp);
            }
            
            session()->put('respuestas',$resps);

            //dd(session()->all());
                
                return redirect($request->url);
           
        }
    }
    
    public function crearRespFalsa(Request $request, $idExam){
        if($request->user()->authorizeRoles([ 'profesor']))
        {
            $resp = new Respuesta();
            $resp->pregunta_id = null;
            $resp->respuesta = $request->resp_erronea;
            $resp->VoF = false;
            $resp->save();
        }
    }

    public function crearPregunta(Request $request, $idExam,$tipo)
    {
       // dd("hola");
        if($request->user()->authorizeRoles([ 'profesor']))
        {

            if($request->tipo == "opcion_multiple")
            {
                $newPreg = new Pregunta();
                if($tipo = "Examen")
                {
                    $newPreg->examene_id= $idExam;
                    //$newPreg->concurso_id= 1;
                }
                else if($tipo = "Concurso")
                {
                    $newPreg->concurso_id= $idExam;
                    //$newPreg->examene_id = 1;
                }
                
                $newPreg->tipoPregunta = $request->tipo;
                $newPreg->pregunta= $request->pregunta;
                $newPreg->valor=(float)$request->valor;
               // dd($idExam);
                $newPreg->save();
               
                $resp = new Respuesta();
                $resp->pregunta_id = $newPreg->id;
                $resp->respuesta = $request->respuesta;
                $resp->VoF = true;
                $resp->save();
                //Respuestas falsas
                
                $resp = new Respuesta();
                $resp->pregunta_id = $newPreg->id;
                $resp->respuesta = $request->resp_erronea1;
                $resp->VoF = false;
                $resp->save();
                
                if($request->resp_erronea2!=null)
                {
                    $resp = new Respuesta();
                    $resp->pregunta_id = $newPreg->id;
                    $resp->respuesta = $request->resp_erronea2;
                    $resp->VoF = false;
                    $resp->save();
                }
                if($request->resp_erronea3!=null)
                {
                    $resp = new Respuesta();
                    $resp->pregunta_id = $newPreg->id;
                    $resp->respuesta = $request->resp_erronea3;
                    $resp->VoF = false;
                    $resp->save();
                }
                if($request->resp_erronea4!=null)
                {
                    $resp = new Respuesta();
                    $resp->pregunta_id = $newPreg->id;
                    $resp->respuesta = $request->resp_erronea4;
                    $resp->VoF = false;
                    $resp->save();
                }
                return(\back());
            }
            else if ($request->tipo == "abierta")
            {
                $newPreg = new Pregunta();
                if($tipo = "Examen")
                {
                    $newPreg->examene_id= $idExam;
                    //$newPreg->concurso_id= 1;
                }
                else if($tipo = "Concurso")
                {
                    $newPreg->concurso_id= $idExam;
                    //$newPreg->examene_id = 1;
                }
                
                $newPreg->tipoPregunta = $request->tipo;
                 $newPreg->pregunta= $request->pregunta;
                 $newPreg->valor=$request->valor;
                 $newPreg->save();
                 return(\back());
            }
            else if ($request->tipo =="falso_verdadero")
            {
                $newPreg = new Pregunta();
                if($tipo = "Examen")
                {
                    $newPreg->examene_id= $idExam;
                    //$newPreg->concurso_id= 1;
                }
                else if($tipo = "Concurso")
                {
                    $newPreg->concurso_id= $idExam;
                    //$newPreg->examene_id = 1;
                }
                
                $newPreg->tipoPregunta = $request->tipo;
                $newPreg->pregunta= $request->pregunta;
                $newPreg->valor=$request->valor;
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
                
                $examen = Examene::findOrFail($idExam);
                $pregunta = $examen->pregunta()->simplePaginate(1);
                $respuestas = Pregunta::findOrFail($pregunta[0]->id)->respuesta;
                $urls = $pregunta->getUrlRange(1,$examen->pregunta()->count());
                
                
                if($pregunta->count()>0)
                {
                    session()->put('modoExam',$examen->tipo);
                    //session()->put('time_inicio',Carbon::now());
                    $times = session()->get('time_inicio');
                    if($times[$pregunta[0]->id]=="st")
                    {
                        $times[$pregunta[0]->id] = Carbon::now(); 
                        
                        session()->put('time_inicio',$times);
                    }
                    $timeIni = $times[$pregunta[0]->id];
                    //dd($times);
                    return view('examen',compact('examen','pregunta','respuestas','urls','timeIni'));
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
