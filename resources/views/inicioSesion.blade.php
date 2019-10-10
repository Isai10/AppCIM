@extends('plantilla')
@section('seccion')
<div class = "container p-4 mt-5 shadow-sm rounded-lg bg-white " style="width: 25rem;">
<form>
  <div>
    <h1 class = "mt-1 display-4 text-center">Iniciar Sesion</h1>
  </div>  
  <br>
  <div class="form-group">
    <label for="exampleInputEmail1">Correo electronico</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">No compartiremos su correo electronico con nadie mas.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Contraseña</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Recordarme</label>
  </div >
  <a href = "{{route('mainUsuario')}}"  class="btn btn-primary btn-block">
   Iniciar
  </a>
      
  
 
</form>
</div>
@endsection