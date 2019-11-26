<?php

namespace App\Http\Controllers;
use App\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PagesControllerMaestro extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function crearCurso(Request $request)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        {
            
            $curso = new Curso();
            $curso->nombre = $request->nombre;
            $curso->idProfesor = $request->user()->id;
            $curso->save();
            
            return back();
        }
        else {
            return back();
        }
    }
    public function eliminarCurso(Request $request,$id,$idUser)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        {
            $curseDel = DB::table('cursos')->where('id', '=',$id)->where('idProfesor','=',$idUser)->delete();
           
            return back();
        }
        else {
            return back();
        }
    }
    
}
