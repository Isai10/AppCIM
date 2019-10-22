<?php

namespace App\Http\Controllers;
use App\Curso;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
class PagesController extends Controller
{
    public function inicio()
    {
        return view("welcome");
    }
    public function inicioSesion()
    {
        return view('inicioSesion');
    }
    public function registroUsuario()
    {
        return view('registroUsuario');
    }
    public function principalUsuario()
    {
        return view('principalUsuario');
    }
    public function cursoProfesor(Request $request,$idCurso,$idUser)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        {
            $curso = Curso::findOrFail($idCurso);
            $profesor = User::findOrFail($curso->idProfesor);
            $rol = User::findOrFail($idUser)->getRole();
            return view('cursoAlumno',compact('curso','profesor','rol'));
        }
        else
        {
            return redirect('home');
        }
    }
    
    
    public function crearExamen()
    {
        return view('crearExamen');
    }

    public function crearPregunta()
    {
        return view('crearPregunta');
    }
}
