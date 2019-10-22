@extends('layouts.app')
@section('content')
<div class =""  >
        <h1 class="mt-3 display-1 text-center " > Actividades</h1>
        <div class ="container   bg-light p-3 rounded-lg">
                <div class ="container shadow-sm m-5    bg-white p-3 rounded-lg" style="width: 90%";>
                                <div class="btn-toolbar d-flex flex-row-reverse" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-groupmr-5 " role="group" aria-label="Third group">
                                                 <a href="" class="btn btn-info  text-white" data-toggle="modal" data-target="#exampleModal">Crear actividad</a>
                                        </div>
                                      </div>
                               </div>
        @php
            $countSkip = 0;
            $idUser = Auth::user()->id;
        @endphp
        <div class = "row ml-5">
            
                @for ($cont=0;$cont<5; $cont++ )
                <ul class="list-group list-group-horizontal shadow-sm border-0  m-2 ">
                        <li class="list-group-item border-0 "><h5 class = "font-weight-bold text-left">Nombre actividad</h5></li>
                        <li class="list-group-item border-0">Tipo: Examen</li>
                        <li class="list-group-item border-0"> <a href="#" class="btn-light btn-sm  ">Editar</a></li>
                        <li class="list-group-item border-0"> <a href="#" class="btn btn-primary btn-sm  ">Ver actividad</a></li>
                       
                        <li class="list-group-item border-0"><a href="#" class="close btn text-right btn-sm " aria-label="Close">
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
                        
                @endfor
        </div>
        

                
                
               
                
                    
               
               
        </div>
</div>
<br><br>      
 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                  <form action="#" method="POST">
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
                                <select class="form-control" name = "tipo" placeholder="Tipo de actividad" >
                                        <option disabled selected>Tipo</option>
                                        <option value="volvo">Examen</option>
                                        <option value="saab">Tarea</option>
                                </select>
                                

                               
                       
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
@endsection