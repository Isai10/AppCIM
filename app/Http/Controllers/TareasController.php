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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
class TareasController extends Controller
{
    //
    public function modificarTarea(Request $request,$idAct,$idGen)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        {
            DB::table('tareas')->where('id', '=',$idGen)->update(['nombre'=>$request->nombre,'descripcion'=>$request->descripcion]);
            if(strlen($request->hora_fin)==6)
            {
                $fin = Carbon::createFromFormat('Y-m-d H:i:s', (String)($request->fecha. $request->hora_fin.':00'));
            }else{
                $fin = Carbon::createFromFormat('Y-m-d H:i:s', (String)($request->fecha. $request->hora_fin));
            }
                
            DB::table('actividades')->where('id', '=',$idAct)->update(['fin'=>$fin]);
            $dataUser = session()->get("dataUser");
            
            return redirect()->action('ActividadesController@actividad', [$dataUser['id_curso'],$dataUser['id_user']]);
        }
    }
    public function tarea(Request $request,$idAct,$idGen)
    {
        if($request->user()->authorizeRoles([ 'profesor','alumno']))
        {
           
            $tarea= Tarea::findOrFail($idGen);
            $actividad= Actividade::findOrFail($idAct);
            $archivos = DB::table('archivos')->where('actividade_id', '=',$idAct)->where('user_id','=',$request->user()->id)->get();
            return view('tarea',compact('tarea','actividad','archivos'));
        }

    }
}
