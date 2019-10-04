@extends('plantilla')
@section('seccion')
<div class = "container p-4  shadow-sm  mt-5 rounded bg-white" style="width: 25rem;">
<form>
  <div>
    <h1 class = "mt-1 display-4 text-center">Registrarme</h1>
  </div>  
  <br>
  
    <div class="row mb-4">
        <div class="col">
        <input type="text" class="form-control" placeholder="Nombre">
        </div>
        <div class="col">
        <input type="text" class="form-control" placeholder="Apellidos">
        </div>
    </div>
  <div class="form-group">
    <!--<label for="exampleInputEmail1">Correo electronico</label>-->
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Correo electronico">
    <small id="emailHelp" class="form-text text-muted">No compartiremos su correo electronico con nadie mas.</small>
  </div>
  <div class="form-group">
    <!--<label for="exampleInputPassword1">Contraseña</label>-->
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
  </div>
  <div class="form-group">
        <!--<label for="exampleInputPassword1">Contraseña</label>-->
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Repetir contraseña">
      </div>
  <!--<div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Recordarme</label>
  </div>-->
  <a href = "{{route('inicioSesion')}}"  class="btn btn-primary btn-block">
        Enviar
       </a>
</form>
</div>
@endsection