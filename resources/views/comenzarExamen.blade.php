@extends('layouts.app')

@section('content')
<br><br><br><br><br>
<div class = "container">

        <div class = "  p-4   ml-1  mt-5 shadow-sm rounded-lg bg-white " style="width: 50rem; height: 25rem;">
            <div class ="row">
                    <div class ="col">
                            <h2>{{$examen->nombre}}</h2>
                            @if ($examen->tipo=="Normal")
                            <p>Estas apunto de comenzar el examen. El examen consta de <strong>{{$examen->pregunta()->count()}} </strong> preguntas y tiene una duracion de <strong>{{$duracion}}</strong>.
                            <br>El examen solo tiene 1 intento, una vez completado el examen y enviadas tus respuestas no podras volver a contestarlo</p>
                            @else
                                <p>Estas apunto de comenzar el examen <strong>tipo concurso</strong>, el cual consta de <strong>{{$examen->pregunta()->count()}}</strong>preguntas.</p>
                                <br><br><br>
                                <p class = "text-center">Tiempo restante:</p>
                                <p id="time" class = "text-center"></p>
                            @endif
                            
                            
                    </div> 
            </div>
           <br><br><br><br><br><br><br><br><br>
           <form  id = "form-resp" action="{{route('curso.actividad.examen.redirect')}}" method="POST" onsubmit="return enviar();">
           @csrf
                <div class ="row ">
                <div class = "col d-flex flex-row-reverse bd-highlight ">
                        <a class = "btn btn-primary "  id="button-comenzar" style="display:none"href="{{route('curso.actividad.examen',['idExam'=>$examen->id])}}">Comenzar</a>
                </div>
            </div>
            <input type="text" class="form-control" id="urlPage" name ="url" style="display:none">
            </form>
           
    </div>
    <script type>
        // Set the date we're counting down to
        var countDownDate =  new Date(@json($inicio)).getTime();
       // console.log(@json($inicio->addMinutes($minutos)));
        
        // Update the count down every 1 second
        var x = setInterval(function() {
        
          // Get today's date and time
          var now = new Date().getTime();
        console.log(now);
        
          // Find the distance between now and the count down date
          var distance = countDownDate - now;
        
          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
          // Display the result in the element with id="demo"
          document.getElementById("time").innerHTML = "<h1>"+ days + "d " + hours + "h "
          + minutes + "m " + seconds + "s " + "</h1>";
        
          // If the count down is finished, write some text
          if (distance < 0) {
            clearInterval(x);
            document.getElementById("time").innerHTML = "EXPIRED";
            if(@json($examen->tipo)=="Concurso")
            {
                var inputUrl = document.getElementById('urlPage');
                inputUrl.value = document.getElementById("button-comenzar").href;
                document.getElementById('form-resp').submit();

            }else{
                    document.getElementById('btn-comenzar').style.display="block";
            }
            
          }
        }, 1000);
        </script>
</div>

<br><br><br><br><br>

@endsection