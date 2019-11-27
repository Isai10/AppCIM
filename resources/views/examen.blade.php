@extends('layouts.app')

@section('content')
<br><br><br>
<div class = "container mt-5 pt-5">
    
    <div class ="row">
        <div class = "  p-4   mr-1 mt-5 shadow-sm rounded-lg bg-white" style="width: 15rem; height: 15rem;">
            <h6>Duracion: <strong>90:00</strong> min</h6>
            <h6>Examen: <strong>{{$examen->nombre}}</strong> </h6>
            <div class="btn-group-toggle" >
            
                    @php
                    $i=1;   
                   @endphp
                   @foreach ($urls as $url )
                        @if ($i == $pregunta->currentPage())
                            <a    href="{{$url}}" class = "btn btn btn-light mt-2 mb-2 text-black active"><strong>{{$i}}</strong></a>
                        @else
                            <a   href="{{$url}}" class = "btn btn btn-light mt-2 mb-2 text-black"><strong>{{$i}}</strong></a>
                        @endif
                    @php
                        $i++;
                    @endphp
                   @endforeach

        </div>
        </div>
    <form  id = "form-resp" action="{{route('curso.actividad.examen.pregunta.resp.temp',['idPreg'=> $pregunta[0]->id ])}}" method="POST" onsubmit="return enviar();">
    @csrf 
    <div>
        <div class = "  p-4   ml-1  mt-5 shadow-sm rounded-lg bg-white" style="width: 50rem; height: auto;">

            <div class="container bg-white mt-5">
                <div class="container ml-3 mr-3">
                  <h1 class="display-6">{{$pregunta[0]->pregunta}}</h1>
                    @php
                        $resps = session()->get('respuestas');
                        
                    @endphp
                    <div class="container mt-4">
                        
                        @if($pregunta[0]->tipoPregunta=="opcion_multiple")
                                @foreach ($respuestas as $respuesta)
                                <div class="form-check mt-2 mb-2">
                                    
                                @if ($resps[$pregunta[0]->id] == $respuesta->id)
                                    <input class="form-check-input check-input-resp" type="radio" name="idResp" id="exampleRadios1" checked value={{$respuesta->id}} onclick="GuardaRespuesta()" >
                                @else
                                    <input class="form-check-input check-input-resp" type="radio" name="idResp" id="exampleRadios1"  value={{$respuesta->id}} onclick="GuardaRespuesta()" >
                                @endif
                                        <label class="form-check-label" for="exampleRadios1" >
                                         {{$respuesta->respuesta}}
                                        </label>
                                </div>
                                @endforeach 
                                @endif
                        @if($pregunta[0]->tipoPregunta=="falso_verdadero")
                        <div class="form-check mt-2 mb-2">
                                @if ($resps[$pregunta[0]->id] == $respuesta->id)
                                 <input class="form-check-input" type="radio" name="exampleRadios1" id="exampleRadios1" name = "idResp" checked value={{$respuesta->id}} >
                                @else
                                <input class="form-check-input" type="radio" name="exampleRadios1" id="exampleRadios1" name = "idResp"  value={{$respuesta->id}} >
                                @endif
                                <label class="form-check-label" for="exampleRadios1">
                               Falso
                                </label>
                            </div>
                            <div class="form-check mt-2 mb-2">
                                    @if ($resps[$pregunta[0]->id] == $respuesta->id)
                                    <input class="form-check-input" type="radio" name="exampleRadios1" id="exampleRadios1" name = "idResp" checked value={{$respuesta->id}} >
                                   @else
                                   <input class="form-check-input" type="radio" name="exampleRadios1" id="exampleRadios1" name = "idResp"  value={{$respuesta->id}} >
                                   @endif
                                    <label class="form-check-label" for="exampleRadios1">
                                    Verdadero
                                    </label>
                                </div>
                        @endif
                        @if($pregunta[0]->tipoPregunta=="abierta")
                        <label for="descripcion"></label>
                        @if ($resps[$pregunta[0]->id] != null && $resps[$pregunta[0]->id] != "sc" )
                        
                        <textarea class="form-control" rows="4" id="descripcion" name = "resp" > {{$resps[$pregunta[0]->id]}}</textarea>
                        @else
                        <textarea class="form-control" rows="4" id="descripcion" name = "resp" ></textarea>
                        @endif
                        
                        @endif
                        @if ($pregunta->currentPage()== $examen->pregunta->count())
                        <div class = "mt-5  text-center">
                        <a class="btn btn-primary" id="button-fin" href="{{route('curso.actividad.examen.enviar')}}" onclick="return false;" role="button">Terminar examen</a>    
                            </div>
                        @endif
                       
                        
                       
                        

                            
                    </div>
               
              </div>
              
            </div>
           
           <!-- <div class = "mt-5  text-center">
                    <a class="btn btn-primary" href="#" role="button">Siguiente</a>    
                    </div>-->
        </div>
        <div class = "mt-3 ml-6 row justify-content-center  ">
                {{$pregunta->links()}} 
        </div>
     </div> 
    </div>
    <input type="text" class="form-control" id="urlPage" name ="url" style="display:none">
    </form>
        
</div>
<br><br><br><br>

<script type="text/javascript">
    
</script>

@endsection