<div class = "container p-4    mt-5 shadow-sm rounded-lg bg-white" style="width: 40rem; height: auto;">
        <div class ="border-bottom pb-3 mb-2">
        <div  >
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
        </div>
        <div class = "row ml-0 mr-0 mt-4">
            
            
            @foreach ($preguntas as $pregunta)
                
                <ul class="list-group list-group-horizontal shadow-sm border-0  m-2 col ">
                        <li class="list-group-item border-0 "><h6 class = "font-weight-bold text-left">{{$pregunta->pregunta}}</h5></li>
                        <li class="list-group-item border-0 "><h6 class = "">Valor: <strong>3 pts</strong></h5></li>    
                        <li class="list-group-item border-0"> <a href="#" class="btn-light btn-sm  ">Editar</a></li>
                        <!--<li class="list-group-item border-0"> <a href="#" class="btn btn-primary btn-sm  ">Ver actividad</a></li>-->
                        <li class="list-group-item border-0"><a href="{{route('curso.actividad.examen.pregunta.eliminar',$pregunta->id)}}" class="close btn text-right btn-sm " aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </a></li>
                </ul>
                <div class="w-100"></div>
              <!--  <div class="card  m-2 bd-highlight m-1 text-center  col-lg-11 shadow-sm border-0 pl-0 pr-0" style="width: 18rem; ">  
                        <ul class="list-group list-group-horizontal">
                                <div class="card-body pl-4 pr-4 pt-2">
                                    <div class = "row">
                                            <h5 class=" font-weight-bold text-left col-md-3 ">Nombre actividad</h5>
                                            <h6 class=" text-muted text-left col pt-3 ">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam, obcaecati.</h6>
                                            <a href="#" class="btn btn-warning col-md-1 btn-sm ">Editar</a>
                                            <a href="#" class="close btn text-right btn-sm " aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                            </a>
                                    </div>
                                        
                                </div>
                        </div> -->
            @endforeach
                        
        </div>
            <br>
</div>  