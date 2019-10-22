<?php

namespace App\Http\Controllers;

use App\Curso;
use Illuminate\Http\Request;

class ActividadesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function actividad(Request $request)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        {
            return view('actividad');
        }
    }
    public function crearActividad(Request $request)
    {
        if($request->user()->authorizeRoles([ 'profesor']))
        {
            
            return view('actividad');
        }
    }
    
    
    
}
