@extends('layouts.app')

@section('content')
<br><br><br><br><br>
<div class = "container">
    
    <div class = "  p-4   ml-1  mt-5 shadow-sm rounded-lg bg-white " style="width: 50rem; height: 25rem;">
            <div class ="row border-bottom mb-3 ml-2 mr-2">
                    <div class ="col">
                            <h2>Nombre del examen</h2>
                            <h6>Resumen de preguntas contestadas</h6>
                    </div> 
            </div>
            <div class = "row mb-3 ml-2 mr-2">
                    <div class = "col d-flex flex-row-reverse bd-highlight ">
                    <label><strong>Contestada</strong></label>
                    <button type="button" class="btn btn-warning  ml-3 mr-3 btn-sm"></button>
                    <label><strong>Sin contestar</strong></label>
                    <button type="button" class="btn bg-light  ml-3 mr-3 btn-sm"></button>
                    </div>
                    
            </div>
            <div class = "row ml-0 mr-0 mt-4">
            
                    @php
                        $respuestas = session()->get('respuestas');
                        $totalPreg = count($respuestas);
                        $numpreg=1;
                    @endphp
                    @foreach ($respuestas as $respuesta)
                                @if($respuesta == "sc" || $respuesta == null)
                                <ul class="list-group list-group-horizontal shadow-sm border-0  m-2 row  bg-light ">
                                        <li class="list-group-item border-0  bg-light text-dark "><h6 class = "font-weight-bold text-left"><strong>Pregunta {{$numpreg}}</strong></h5></li>
                                        </ul>
                                @else
                                
                                <ul class="list-group list-group-horizontal shadow-sm border-0  m-2 row bg-warning">
                                        <li class="list-group-item border-0 bg-warning text-dark "><h6 class = "font-weight-bold text-left"><strong>Pregunta {{$numpreg}}</strong></h5></li>
                                    </ul>
                                @endif                                
                            
                        @php
                            $numpreg++;
                        @endphp
                    @endforeach
                                
                </div>
                <br><br><br><br><br>
            <div class ="row ">
                <div class = "col d-flex flex-row-reverse bd-highlight ">
                        <a class = "btn btn-primary " href="{{route('curso.actividad.examen.enviar.save')}}">Eviar y terminar</a>
               </div>
            </div>
    </div>
    
</div>
<br><br><br><br>
@endsection