<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function inicio()
    {
        return view('welcome');
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
    public function principalMaestro()
    {
        return view('principalMaestro');
    }
    public function cursoAlumno()
    {
        return view('cursoAlumno');
    }
    public function cursoProfesor()
    {
        return view('cursoEditProfesor');
    }
    public function crearExamen()
    {
        return view('crearExamen');
    }
}
