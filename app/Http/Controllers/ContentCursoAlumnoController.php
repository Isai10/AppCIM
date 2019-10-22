<?php

namespace App\Http\Controllers;
use App\Curso;
use App\User;
use Illuminate\Http\Request;

class ContentCursoAlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function cursoAlumno(Request $request,$idCurso)
    {
        if($request->user()->authorizeRoles([ 'alumno']))
        {
            $curso = Curso::findOrFail($idCurso);
            $profesor = User::findOrFail($curso->idProfesor);
            return view('cursoAlumno',compact('curso','profesor'));
        }
        else
        {
            return redirect('home');
        }
        
    }
}
