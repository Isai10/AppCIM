@extends('layouts.app')

@section('content')
<div class = "container">
        <form action="{{route('curso.actividad.archivo.subir',['idAct'=>$actividad->id])}}" enctype="multipart/form-data" method="post">

    <div class = "  p-4   ml-1  mt-5 shadow-sm rounded-lg bg-white " style="width: 50rem; height: auto;">
                <div class="form-group">
                    <h1 class="mb-4 ">{{ $tarea->nombre}}</h1>
                </div>
                <div class=" mb-4 form-group">
                    <p>{{$tarea->descripcion}}</p>
                 </div>
                <div class="bg-light pb-4 pt-4 rounded-lg ml-1 mr-1 pr-3 pl-3">
                                {{ csrf_field() }}
                                <div class="form-group ">
                                 <!-- <label for="exampleFormControlFile1">Example file input</label>-->
                                  <input type="file" class="form-control-file btn btn-warning" id="exampleFormControlFile1" name = "archivo">
                                </div>
                              
                    </div>
                        
               
            <div class ="row mt-4">
                <div class = "col  d-flex flex-row-reverse bd-highlight">
                        <div class="form-group">
                                <button class = "btn btn-primary " type="submit">Guardar</button>
                        </div>
                </div>
            </div>
    </div>
</form>
</div>
@endsection