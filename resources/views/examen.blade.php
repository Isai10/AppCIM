@extends('layouts.app')

@section('content')
<br><br><br>
<div class = "container mt-5 pt-5">
    
    <div class ="row">
        <div class = "  p-4   mr-1 mt-5 shadow-sm rounded-lg bg-white" style="width: 15rem; height: 15rem;">
            
            @if ($examen->tipo=="Normal")
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
            
            
            @else
                <h6>Examen tipo <strong>concurso</strong>: <strong>{{$examen->nombre}}</strong> </h6>
                <h6>Tiempo restante: </h6>
                <p id="time" class = "ml-3"></p>
            @endif
            
        </div>
    <form  id = "form-resp" action="{{route('curso.actividad.examen.pregunta.resp.temp',['idPreg'=> $pregunta[0]->id,'tipo'=>$examen->tipo ])}}" method="POST" onsubmit="return enviar();">
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
                        @php
                            $fin = false;
                        @endphp
                        @if ($pregunta->currentPage()== $examen->pregunta->count())
                        @php
                            $fin = true;
                        @endphp
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
  


// Set the date we're counting down to
var countDownDate =  new Date(@json($timeIni->addSeconds(60))).getTime();
//console.log(countDownDate);
//@json($timeIni->toFormattedDateString() ." " . $timeIni->toTimeString()." GMT");
// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("time").innerHTML = "<h1>"+/*+ days + "d " + hours + "h "
  + minutes + "m " +*/ seconds + "s " + "</h1>";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("time").innerHTML = "EXPIRED";
    
    if(!@json($fin))
    {
        var inputUrl = document.getElementById('urlPage');
        inputUrl.value = document.getElementById("button-next").href;
        document.getElementById('form-resp').submit();
    }
    else{
        var inputUrl = document.getElementById('urlPage');
    inputUrl.value = document.getElementById("button-fin").href;
    document.getElementById('form-resp').submit();
    }
  }
}, 1000);
</script>

@endsection