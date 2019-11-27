@extends('layouts.app')

@section('content')
<br><br><br><br>
<div class = "container">
<form action="{{route('curso.actividad.tarea.modificar',['idAct'=>$actividad->id,'idGen'=>$tarea->id])}}" method="POST">
        @csrf  
    <div class = "  p-4   ml-1  mt-5 shadow-sm rounded-lg bg-white " style="width: 50rem; height: auto;">
                <div>
                <h1 class="mb-4">Modificar tarea</h1>
                                
                </div>
                <div class = "mb-4">
                                <input
                                type="text" name="nombre"
                                placeholder="nombre" class="form-control mb-2"
                                value="{{ $tarea->nombre}}">
                        
                </div>
                       
                        <div class="row mb-4">
                        <div class ="col">
                               <!-- <label for="descripcion">Descripcion de la tarea:</label>-->
                        <textarea class="form-control" rows="4" id="descripcion" name = "descripcion" placeholder="Descripcion de la tarea:">{{$tarea->descripcion}}</textarea>
                        </div>
                        </div>
                <div class="row ">
                        @php
                            $date = date_create($actividad->fin);
                            $fecha=date_format($date, 'Y-m-d');
                            $hora_limite_task =date_format($date, 'H:i:s');
                            
                        @endphp 
                        <div class="col">
                                <div class="form-group">
                            <label for="fecha" class="form-text text-muted">Fecha limite de carga</label>
                                <input type="date" name="fecha"  class="form-control" value="{{$fecha}}" >
                            </div>
                        </div>
                </div>
                    <div class="row mb-2">
                        <div class="col-sm-6">
                                <div class="form-group">
                                <label for="hora_fin" class="form-text text-muted">Hora de cierre</label>
                                <input type="time" value="{{$hora_limite_task}}" class="form-control" name ="hora_fin">
                                </div>
                        </div>
                    </div> 
               
            <div class ="row ">
                <div class = "col  d-flex flex-row-reverse bd-highlight">
                        <div class="form-group">
                                <button class = "btn btn-primary " type="submit">Guardar</button>
                        </div>
                </div>
            </div>
    </div>
</form>
</div>
<br><br><br><br>
@endsection