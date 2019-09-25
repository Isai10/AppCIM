
@extends('plantilla')

@section('seccion')
    <div class="container">
            <div class = "container border rounded mt-5 " style="width: 35rem; background-color:cadetblue;">
                    <br><br><br><br><br><br><br><br><br><br><br>
                </div>
        <h1 class="mt-3 display-1 text-center" > ¡Bienvenido!</h1>
        <h1 class=" h6 text-center" > Sistema de curso para Capacitación CIM</h1>
        <div style= "text-align: center;" class="fondo mt-3">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                nisi ut aliquip ex ea commodo consequat.        
        </div>
        <img src="{{ asset('images/image1.jpg') }}" alt="" style="width: 18rem;">
        <br><br><br>

    </div>
 
@endsection