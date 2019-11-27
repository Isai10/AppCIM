
@extends('layouts.app')

@section('content')
    <!--<div class="container">
            <div class = "container border rounded  mt-5" style="width: 35rem; background-image:url({{asset('images/image1.jpg')}}); ">
                    <br><br><br><br><br><br><br><br><br><br><br>
                </div>
        <h1 class="mt-3 display-1 text-center" > ¡Bienvenido!</h1>

        <h1 class=" h6 text-center" > Sistema de curso para Capacitación CIM</h1>
        <div style= "text-align: center;" class="fondo mt-3 ">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                nisi ut aliquip ex ea commodo consequat.        
        </div>  
    </div>--->

<div class="banner">
        <div class="banner-text">
                <div class="row">
                        <div class="col-md-6">
                                <h1 class="mt-3">SISTEMA PARA CURSO DE CAPACITACIÓN CIM</h1>
                                <h3 class="mt-3">Centro de Investigación de Materiales</h3>
                                <h6 style= "text-align: center;" class="fondo mt-3 pl-5 pr-5 ">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                                nisi ut aliquip ex ea commodo consequat. </h6>
                        </div>
                        <div class="col-md-6">
                               
                        </div>           
                </div>                       
        </div>
</div>

 <style>
         .banner{
                background-image:url({{asset('images/fondo.jpg')}});
         }
       
 </style>
@endsection