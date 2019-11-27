@extends('layouts.app')
@section('content')
<br><br><br><br>
<div class =""  >
        <h1 class="mt-3 display-1 text-center " > Actividades</h1>
        <div class ="container   bg-light p-3 rounded-lg">
                <div class ="container shadow-sm m-5    bg-white p-3 rounded-lg" style="width: 90%";>
                                
                                @if($rol->nombre=="profesor")
                                <div class="btn-toolbar d-flex flex-row-reverse" role="toolbar" aria-label="Toolbar with button groups">
                                               
                                        <div class="btn-groupmr-5 " role="group" aria-label="Third group">
                                                 <a href="" class="btn btn-info  text-white" data-toggle="modal" data-target="#exampleModal">Crear actividad</a>
                                        </div>
                                
                                      </div>
                                      @endif 
                               </div>
        @php
            $countSkip = 0;
            $idUser = Auth::user()->id;
        @endphp
        <div class = "row ml-5">
            
                @foreach ($actividades as $actividad )
                <ul class="list-group list-group-horizontal shadow-sm border-0  m-2 ">
                        <li class="list-group-item border-0 "><h5 class = "font-weight-bold text-left">{{$actividad['nombre']}}</h5></li>
                        <li class="list-group-item border-0">Tipo: {{$actividad['tipo']}}</li>
                        @if($rol->nombre=="profesor")
                        <li class="list-group-item border-0"> <a href="{{route('curso.actividad.editar',['idAct'=>$actividad['id'],'idTipo'=>$actividad['id_tipo'], 'idActGen' => $actividad['id_act_gen'] ])}}" class="btn-light btn-sm  ">Editar</a></li>
                        @endif

                        @if(!$actividad['realizada'])
                                @if ($actividad['tipo']=='Examen' ||$actividad['tipo']=='Concurso' )
                                        <li class="list-group-item border-0"> <a href="{{route('curso.actividad.examen.comenzar',['idExam'=>$actividad['id_act_gen'],'idAct'=>$actividad['id'],'tipoAct'=>$actividad['tipo']])}}" class="btn btn-primary btn-sm  ">Ver actividad</a></li>
                                @else 
                                    @if ($actividad['tipo']=='Tarea')
                                        <li class="list-group-item border-0"> <a href="{{route('curso.actividad.tarea',['idAct'=>$actividad['id'],'idGen'=>$actividad['id_act_gen']])}}" class="btn btn-primary btn-sm  ">Ver actividad</a></li>
                                    @else
                                        
                                    @endif
                                @endif
                        
                        @else
                        
                        <li class="list-group-item border-0 "> <a href="{{route('curso.actividad.examen.comenzar',['idExam'=>$actividad['id_act_gen'],'idAct'=>$actividad['id'],'tipoAct'=>$actividad['tipo']])}}"  class="btn btn-success btn-sm disabled ">Realizada</a></li>
                        @endif
                        @if($rol->nombre == "profesor")
                        <li class="list-group-item border-0"><a href="{{route('curso.actividad.eliminar',['idAct'=>$actividad['id'],'tipo'=>$actividad['tipo'],'idGen'=>$actividad['id_act_gen']])}}" class="close btn text-right btn-sm " aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </a></li> 
                        
                        @endif
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
        

                
                
               
                
                    
               
               
        </div>
</div>
<br><br>      
 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                  <form action="{{route('curso.actividad.crear',['idCurso'=>$idCurso])}}" method="POST">
                  <div class="modal-content border-0">
                    <div class="modal-header border-0">
                      <h5 class="modal-title" id="exampleModalLabel">Crea nueva actividad</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body ">
                       
                                @csrf
                                <input
                                type="text" name="nombre"
                                placeholder="Nombre de la actividad" class="form-control mb-2"
                                value="{{ old('nombre') }}">
                                <select class="form-control select" name = "tipo" placeholder="Tipo de actividad"  onclick="ActivarControlesAct();">
                                        <option disabled selected >Tipo</option>
                                        <option value="examen" >Examen</option>
                                        <option value="tarea">Tarea</option>
                                        <option value="concurso">Concurso</option>
                                </select>
                        <div class="actividadControles" > 
                              <!--  <div class="row mb-4">
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="Título">
                                                </div>
                                                
                                            </div>
                                            
                                            
                                            <div class="row mb-4">
                                                <div class="col">
                                                    <select class="form-control"  placeholder="Tema" >
                                                        <option disabled selected>Tema</option>
                                                        <option value="volvo">Volvo</option>
                                                        <option value="saab">Saab</option>
                                                        <option value="mercedes">Mercedes</option>
                                                        <option value="audi">Audi</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                   
                                                    <div class="col">
                                                            <div class="form-group">
                                                        <label for="fecha" class="form-text text-muted">Fecha de examen</label>
                                                        <input type="date" name="fecha"  class="form-control" >
                                                        </div>
                                                    </div>
                                                     
                                            </div>
                                            <div class="row mb-4">
                                                   
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                        <label for="hora_inicio" class="form-text text-muted">Hora de inicio</label>
                                                        <input type="time"  value="10:45:00"class="form-control" name ="hora_inicio">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                            <div class="form-group">
                                                            <label for="hora_fin" class="form-text text-muted">Hora de cierre</label>
                                                            <input type="time" value="11:45:00" class="form-control" name ="hora_fin">
                                                            </div>
                                                        </div>
                                                     
                                            </div>
                                        -->
                        </div>
                       
                    </div>
                    <div class="modal-footer border-0">
                     <button type="submit" class="btn btn-primary">Crear</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     
                    </div>
                  </div>
                </form>
                </div>
              </div>
</div>
<br><br><br><br>
@endsection