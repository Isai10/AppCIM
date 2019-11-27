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
    public function saveRespuestas(Request $request)
    {
        if($request->user()->authorizeRoles([ 'profesor','alumno']))
        {
            $respuestas = session()->get("respuestas");
            $dataUser = session()->get("dataUser");
            $preguntas = Examene::findOrfail($dataUser['id_exam'])->pregunta()->get();
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
           $reg_activ = new RegistroActividade();
              $reg_activ->user_id = $dataUser['id_user'];
              $reg_activ->actividade_id = $dataUser['id_act'];
              $reg_activ->estado = "REALIZADA";
              $reg_activ->saveOrFail();
              return redirect()->action('ActividadesController@actividad', [$dataUser['id_curso'],$dataUser['id_user']]);
        }
    }
    public function enviarExamen(Request $request)
    {
        if($request->user()->authorizeRoles([ 'profesor','alumno']))
        {
            return view('enviarExamen');
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
                }
                $resps = Arr::set($resps,$idstr,'sc');
            }
            session()->put('respuestas',$resps); //Almacena las respuesatas temporales en la session
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
            return view('comenzarExamen',compact('examen','duracion'));
        }
    }
    public function saveRespTemp(Request $request,$idPreg)
    {
        if($request->user()->authorizeRoles([ 'profesor','alumno']))
        {
            if($request->has('idResp'))
            {
                $resps = session()->get('respuestas');
                $resps[$idPreg] = (int)$request->idResp;
            }
            else if($request->has('resp'))
            {
                $resps = session()->get('respuestas');
                $resps[$idPreg] = $request->resp; 
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
                   
                    return view('examen',compact('examen','pregunta','respuestas','urls'));
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
