<?php

namespace App\Http\Controllers;
use App\Curso;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContentCursoAlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function cursoAlumno(Request $request,$idCurso,$idUser)
    {
        if($request->user()->authorizeRoles([ 'alumno']))
        {
            $curso = Curso::findOrFail($idCurso);
            $profesor = User::findOrFail($curso->idProfesor);
            $user = User::findOrFail($idUser);
            $rol = User::findOrFail($idUser)->getRole();
            return view('cursoAlumno',compact('curso','user','rol','profesor'));
        }
        else
        {
            return redirect('home');
        }
        
    }
    public function alumnosActivar(Request $request,$idCurso,$idUser)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        {
            DB::table("curso_user")->where('user_id',"=",$idUser)->update(array('status' => "ACTIVO"));
            return(back());

        }

    }
    public function alumnos(Request $request,$idCurso,$idUser)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        {
            $curso = Curso::findOrFail($idCurso);
            $profesor = User::findOrFail($curso->idProfesor);
            $user = User::findOrFail($idUser);
            $rol = User::findOrFail($idUser)->getRole();
            
            $alumnos = $curso->User()->get();
             
           // dd($alumnos);
            if($profesor->id == $curso->idProfesor)
            {
                return view('alumnos',\compact('alumnos','curso'));
            }
            else{
                return back();
            }
            
        }
    }
}
