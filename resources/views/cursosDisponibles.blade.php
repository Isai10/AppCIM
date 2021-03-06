@extends('layouts.app')

@section('content')
<br><br><br><br>
    <div class =""  >
        
       <h1 class="mt-3 display-1 text-center " > Cursos Disponibles</h1>
       <br><br>
       <div class = "container">
                <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="{{route("mainUsuario")}}">Inicio</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">Curso</li>
                                </ol>
                              </nav>
    </div>
<div class ="container   bg-light p-3 rounded-lg " style="width: 90%";>
        @if ( session('mensaje') )
        
                <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('mensaje') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                </button>
                </div>
                
        @endif
        @if ( session('error') )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                </button>
                </div>
        @endif
        @php
            $idUser = Auth::user()->id;
            $countSkip = 0;
        @endphp
        <div class = "row">
               
                @foreach ($cursos as $curso)
                @php
                         $cursoExiste = Illuminate\Support\Facades\DB::table('curso_user')->where('user_id',$idUser)->where('curso_id',$curso->id)->exists();
                @endphp
                <br>
                
                        <div class="card mb-auto m-2 bd-highlight m-1 text-center col-md-2  shadow-sm border-0" > 
                                       
                                <div class="card-body">
                                        
                                        <h5 class="card-title font-weight-bold text-left">{{$curso->nombre}}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted text-left">{{ $curso->name}}</h6>
                                        <br>
                                        
                                                
                                        @if (!$cursoExiste)
                                                <a href="{{route('curso.add',['id' => $curso->id , 'iduser' => $idUser])}}" class="btn btn-primary">Agregar</a>
                                        @else
                                                <a href="{{route('curso.add',['id' => $curso->id , 'iduser' => $idUser])}}" class="btn btn-success disabled">Agregado</a>
                                        @endif
                                </div>
                        </div>
                        @php
                    $countSkip++;
                @endphp
                @if ($countSkip == 5)
                       @php
                          $countSkip = 0; 
                          
                       @endphp 
                       <div class="w-100"></div>
                @endif
                
                @endforeach 
                
                
        </div>
        
        
</div>
<br><br>    <br><br><br>  
 
    </div>
@endsection