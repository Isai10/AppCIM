<?php

namespace App\Http\Controllers;
use App\Curso;
use App\User;
use App\Curso_User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MainUsuario extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function principalUsuario(Request $request)
    {
        if($request->user()->authorizeRoles([ 'alumno','profesor']))
        {
            $rol =$request->user()->getRole()->nombre;

            if($rol=='alumno')
                $cursosUser = User::find($request->user()->id);
            else if($rol=='profesor'){
                $cursosUser = Curso::all()->where('idProfesor','=',$request->user()->id);
            }
           // dd($cursosUser);
           /* $cursosUser = $cursosUser
            ->join('users','pivot.user_id','=','users.id')
            ->select('*', 'users.name')
            ->get();*/
           /* $cursosUser = $request->user()
            ->with('curso')
            ->where('id','=',
            $request->user()->id)
            ->pivot->user_id
            ->get();*/
           /* $pivote= DB::table('users AS us')
                ->join('curso_user','us.id', '=', 'curso_user.user_id')
                ->join('cursos','curso_user.curso_id','=','cursos.id')
                ->join('users AS prof','cursos.idProfesor','=','prof.id')
                ->where('users.id','=',1) 
                ->get();*/

           

          /* foreach ($cursosUser as $c) {
            $piv = $c->curso->select('pivot');
               # code...
           }*/
          /*  $cursosUser = DB::table($temp)
            ->join('cursos', $temp->curso_id, '=', 'cursos.id')
            ->join('users',$temp->user_id,'=','users.id')
            ->select('curso_user*', 'cursos.nombre','users.name')
            ->get();*/
            return view('principalUsuario',compact('cursosUser','rol'));
        }else
        {
            return redirect('home');
        }
    }
    public function masCursos(Request $request)
    {
        
        if($request->user()->authorizeRoles([ 'alumno']))
        {
            $cursos = Curso::All(); //Buscamos todos los cursos disponibles 
            //$users = User::All();

            $cursos = DB::table('cursos')
            ->join('users', 'cursos.idProfesor', '=', 'users.id')
            ->select('cursos.*', 'users.name')
            ->get();
           // dd($cursos);
            return view('cursosDisponibles',compact('cursos'));
        }else
        {
            return redirect('home');
        }
    }

    public function addCurso(Request $request,$id,$iduser)
    {
        
        if($request->user()->authorizeRoles([ 'alumno']))
        {
            //Agregamos al alumno un curso
           $usuario = User::findOrFail($iduser);
           if(!$usuario->hasThisCurso($id))
           {
                $usuario->curso()->attach([$id]);
                $cursos = DB::table('cursos')
                ->join('users', 'cursos.idProfesor', '=', 'users.id')
                ->select('cursos.*', 'users.name')
                ->get();
                return back()->with('mensaje', 'Curso agregado');
           }
           else 
           {
                return back()->with('error', 'No se puede agregar este curso porque ya ha sido agregado');
           }
           
        }else
        {
            return redirect('home');
        }
    }
    public function quitarCurso(Request $request,$id,$idUser)
    {
        if($request->user()->authorizeRoles([ 'alumno']))
        {
            $curseDel = DB::table('curso_user')->where('curso_id', '=',$id)->where('user_id','=',$idUser)->delete();
           
            return back();
        }
        else {
            return back();
        }
    }
}
