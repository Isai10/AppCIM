<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentCursoAlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function cursoAlumno(Request $request)
    {
        if($request->user()->authorizeRoles([ 'alumno']))
        {
            return view('cursoAlumno');
        }
        else
        {
            return redirect('home');;
        }
        
    }
}
