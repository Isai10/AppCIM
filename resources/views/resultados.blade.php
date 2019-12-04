@extends('layouts.app')

@section('content')
<br><br><br><br><br>
<div class = "container">
    
    <div class = "  p-4   ml-1  mt-5 shadow-sm rounded-lg bg-white " style="width: 50rem; ">
            <div class ="row  ml-2 mr-2 mb-2" >
                    <div class ="col rounded-lg" >
                    <h4 class = "text-black text-center"><img src="{{asset('images/win.png')}}" alt="#"  width="30" height="30" alt=""> Ganador del concurso</h4>
                    </div>
             </div> 
            <div class ="row border-bottom mb-3 ml-2 mr-2">
                   
                    <div class ="col rounded-lg" style="background: #F7CB15">
                           <h1 class = "text-black text-center">{{$ganador->name}}</h1>
                            
                    </div> 
            </div>
            <div>
               
                    <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">IdAlumno</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Preguntas contestadas</th>
                                <th scope="col">Puntos</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($ganadores_id as $win)
                                
                                    <tr>
                                        <td>{{$win}}</td>
                                        <td>{{$alumnos->find($win)->name}}</td>
                                        @if ($winers[$win] ==-1)
                                        <td>0</td> 
                                        @else
                                        <td>{{$winers[$win]}}</td> 
                                        @endif                                        
                                        <td class = "h4"><strong>{{$puntos[$win]}}</strong></td>
                                    </tr>
                                @endforeach
                              
                            </tbody>
                          </table>
            </div>
            @php
                $dataUser = session()->get('dataUser')
            @endphp

                <br><br><br><br><br>
            <div class ="row ">
                <div class = "col d-flex flex-row-reverse bd-highlight ">
                        <a class = "btn btn-primary " href="{{route('curso.actividad',['idCurso'=>$dataUser['id_curso'],'idUser'=>$dataUser['id_user']])}}">Continuar</a>
               </div>
            </div>
    </div>
    
</div>
<br><br><br><br>
@endsection