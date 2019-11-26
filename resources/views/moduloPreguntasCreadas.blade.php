<div class = "container p-4    mt-5 shadow-sm rounded-lg bg-white" style="width: 40rem; height: auto;">
        <div class ="border-bottom pb-3 mb-2">
        <div  class row >
                Nombre:
              <h1 class = "mt-1 h6 font-weight-bold">{{$examen['examen']}}</h1>
            </div>  
            <div>
                Curso:
                  <h1 class = "mt-1 h6 font-weight-bold ">{{$examen['curso']}}</h1>
                </div>  
                <div>
                    Tema:
                      <h1 class = "mt-1 h6 font-weight-bold">{{$examen['tema']}}</h1>
                    </div>  
                    <div>
                        Duracion:
                          <h1 class = "mt-1 h6 font-weight-bold">{{$examen['duracion']}}</h1>
                        </div>  
        </div>
        <div class = "row ml-0 mr-0 mt-4">
            
            @php
                $numpreg =1;
            @endphp
            @foreach ($preguntas as $pregunta)
                
                <ul class="list-group list-group-horizontal shadow-sm border-0  m-2 col ">
                        <li class="list-group-item border-0 "><h6 class = "font-weight-bold text-left">{{$numpreg}}.- {{$pregunta->pregunta}}</h5></li>
                        <li class="list-group-item border-0 "><h6 class = "">Valor: <strong>{{$pregunta->valor}} pts</strong></h5></li>    
                        <li class="list-group-item border-0"> <a href="#" class="btn-light btn-sm  ">Editar</a></li>
                        <li class="list-group-item border-0 button-ver-preg"> <a href="#" class="btn btn-primary btn-sm  " id= "{{$pregunta->id}}">Ver</a></li>
                        <li class="list-group-item border-0"><a href="{{route('curso.actividad.examen.pregunta.eliminar',$pregunta->id)}}" class="close btn text-right btn-sm " aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </a></li>
                </ul>
                <div class ="container ml-2 mr-2 "id="cont-resp{{$pregunta->id}}" style="display:none" >
                        @php
                                $respuestas = App\Pregunta::findOrFail($pregunta->id)->respuesta;  
                                $inciso = 'A'; 
                        @endphp
                        <div class="row bg-white">
                                
                        <div class="btn-toolbar mt-2 mb-2 d-flex flex-row-reverse"  role="toolbar" style="width: 100%"aria-label="Toolbar with button groups">
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                                <button type="button" class="btn btn-danger btn-sm button-hide-resp " id= "{{$pregunta->id}}"  onclick="OcultaRespuestas();"  >Ocultar</button>
                                        </div>
                        </div>
                                
                               
                        </div>
                        @foreach ($respuestas as $respuesta)
                        @if($respuesta->VoF)
                                <div class="row  row-resp-true">
                                        <div class = "col">
                                                       <strong> {{$inciso}}) {{$respuesta->respuesta}}</strong>
                                        </div>
                                        <div class = "col">
                                                        <strong>  verdadera</strong>
                                        </div>
                                </div>
                                @else
                                <div class="row bg-light">
                                                <div class = "col">
                                                                {{$inciso}}) {{$respuesta->respuesta}}
                                                </div>
                                                <div class = "col">
                                                                falsa
                                                </div>
                                        </div>
                                @endif
                                @php
                                    $inciso++;
                                @endphp
                        @endforeach
                        
                </div>
             <!--   <div class="w-100"></div>-->
                @php
                    $numpreg++;
                @endphp
            @endforeach
                        
        </div>
            <br>
</div>  