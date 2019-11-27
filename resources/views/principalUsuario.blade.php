@extends('layouts.app')

@section('content')
    <div class ="mt-5 pt-5"  >
        
      <div class = "container ">
          <h1 class="mt-3 display-1 text-center " > <img src="{{asset('images/cursos.png')}}"  width="150" height="150" alt="">Mis Cursos</h1>
      </div>
      

<div class ="container   bg-light p-3 rounded-lg">
               
        @php
            $countSkip = 0;
            $idUser = Auth::user()->id;
        @endphp
        <div class = "row ml-5">
                @if ($rol == "alumno")
                @foreach ($cursosUser->curso as $curso )
                <div class="card mb-auto m-2 bd-highlight m-1 text-center  col-md-2 shadow-sm border-0 pl-0 pr-0" style="width: 18rem; ">  
                                <a href="{{route('curso.alumn.quit',['id' => $curso->id , 'idUser' => $idUser])}}" class="close btn text-right btn-sm " aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                </a>
                                <div class="card-body pl-4 pr-4 pt-2">
                                        <h5 class="card-title font-weight-bold text-left">{{$curso->nombre}}</h5>
                                        <h6 class="card-subtitle  text-muted text-left ">{{App\User::find($curso->idProfesor)->name}}</h6>
                                        <br>

                                        <a href="{{route('cursoAlumno',['idCurso'=>$curso->id,'idUser' => $idUser])}}" class="btn btn-warning ">Ver curso</a>
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
                    
                @elseif( $rol=="profesor")
                @foreach ($cursosUser as $curso )
                <div class="card mb-auto m-2 bd-highlight m-1 text-center  col-md-2 shadow-sm border-0 pl-0 pr-0" style="width: 18rem; ">  
                                <a href="{{route('curso.prof.delete',['id' => $curso->id , 'idUser' => $idUser])}}" class="close btn text-right btn-sm " aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                </a>
                                <div class="card-body pl-4 pr-4 pt-2">
                                        <h5 class="card-title font-weight-bold text-left">{{$curso->nombre}}</h5>
                                        <h6 class="card-subtitle  text-muted text-left ">{{App\User::find($curso->idProfesor)->name}}</h6>
                                        <br>
                                        <a href="{{route('cursoProfesor',['idCurso'=>$curso->id,'idUser' => $idUser])}}" class="btn btn-warning ">Ver curso</a>
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
                @endif
                
                     
                
        </div>
        

                
                
               
        <div class ="container shadow-sm m-5    bg-white p-3 rounded-lg" style="width: 90%";>
            <div class="btn-toolbar d-flex flex-row-reverse" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-groupmr-5 " role="group" aria-label="Third group">
                      @if ($rol == 'alumno')
                             <a href="{{route('curso.mas')  }}" class="btn btn-info  text-white">Ver mas cursos</a>
                      @elseif ($rol == 'profesor')
                            <a href="#" class="btn btn-info  text-white"data-toggle="modal" data-target="#exampleModal">Crear curso</a>
                      @endif
                    </div>
                  </div>
           </div>
                    
               
               
        </div>
</div>
<br><br>      
 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                  <form action="{{route('curso.crear')}}" method="POST">
                  <div class="modal-content border-0">
                    <div class="modal-header border-0">
                      <h5 class="modal-title" id="exampleModalLabel">Crea un nuevo curso</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body ">
                       
                                @csrf
                                <input
                                type="text" name="nombre"
                                placeholder="Nombre del curso" class="form-control mb-2"
                                value="{{ old('nombre') }}">
                               
                       
                    </div>
                    <div class="modal-footer border-0">
                     <button type="submit" class="btn btn-primary">Crear</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     
                    </div>
                  </div>
                </form>
                </div>
              </div>
              <script>

    

    

                  /* var channel = Echo.channel('my-channel');
                     channel.listen('.my-event', function(data) {
                     alert(JSON.stringify(data));
                   });*/
               
                  
                   window.Echo.private('user.{{ $idUser }}')
                         .listen('MessageNotification',  (e) => {
                             alert(e.message.message);
                         });
                     </script>
    </div>
    
    
@endsection