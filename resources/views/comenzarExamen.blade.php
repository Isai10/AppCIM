@extends('layouts.app')

@section('content')
<div class = "container">

        <div class = "  p-4   ml-1  mt-5 shadow-sm rounded-lg bg-white " style="width: 50rem; height: 25rem;">
            <div class ="row">
                    <div class ="col">
                            <h2>{{$examen->nombre}}</h2>
                            <p>Estas apunto de comenzar el examen. El examen consta de <strong>{{$examen->pregunta()->count()}}</strong> preguntas y tiene una duracion de <strong>{{$duracion}}</strong>.
                            <br>El examen solo tiene 1 intento, una vez completado el examen y enviadas tus respuestas no podras volver a contestarlo</p>
                    </div> 
            </div>
           <br><br><br><br><br><br><br><br><br>
            <div class ="row ">
                <div class = "col d-flex flex-row-reverse bd-highlight ">
                        <a class = "btn btn-primary " href="{{route('curso.actividad.examen',['idExam'=>$examen->id])}}">Comenzar</a>
                </div>
            </div>
    </div>

</div>
@endsection