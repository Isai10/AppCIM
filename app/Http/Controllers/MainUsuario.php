<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainUsuario extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function principalUsuario()
    {
        if($request->user()->authorizeRoles([ 'alumno']))
        {
            return view('principalUsuario');
        }else
        {
            return redirect('home');
        }
    }
}
