@extends('layouts.app')

@section('content')
<br><br><br><br><br><br><br>
<div class = "container">
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">IdAlumno</th>
            <th scope="col">Nombre</th>
            <th scope="col">Activar</th>
            <th scope="col">Actividades</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($alumnos as $alumno)
                    <tr>
                    <th scope="row">{{$alumno->id}}</th>
                    <td>{{$alumno->name}}</td>
                    <td><div class="custom-control custom-switch">
                        <form action="{{route('curso.alumnos.activar',['idCurso'=>$curso->id, 'idUser'=> $alumno->id])}}" id="form-resp" method="POST">
                           @csrf
                            <input type="checkbox" class="custom-control-input" id="customSwitch" name = "active"   >
                            <label class="custom-control-label" for="customSwitch"></label>
                          </div></td>
                        </form>
                    <td></td>
                  </tr> 
            @endforeach
         
        </tbody>
      </table>
</div>
<br><br><br><br> <br><br><br><br>
@endsection