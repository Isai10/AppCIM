@extends('layouts.app')

@section('content')
<div class = "container">
    <div class ="row">
        <div class = "  p-4   mr-1 mt-5 shadow-sm rounded-lg bg-white" style="width: 15rem; height: 15rem;">
            <h6>Duracion: <strong>90:00</strong> min</h6>
            <h6>Examen: <strong>{{$nombreExamen->nombre}}</strong> </h6>
            <div class="btn-group-toggle" data-toggle="buttons">
            
            
            @for ($i = 0; $i < 10; $i++)
            
                <label class="btn btn btn-light   mt-2 mb-2 text-black "   >
                  <input type="checkbox"  style="width:1rem;"  class = ""checked autocomplete="on"><strong>{{$i}}</strong>
                </label>
             
            @endfor
        </div>
        </div>
    <div>
        <div class = "  p-4   ml-1  mt-5 shadow-sm rounded-lg bg-white" style="width: 50rem; height: 25rem;">

            <div class="container bg-white mt-5">
                <div class="container ml-3 mr-3">
                  <h1 class="display-6">{{  $examen[0]->pregunta}}</h1>
                    <div class="container mt-4">
                        @if($examen[0]->tipoPregunta=="opcion_multiple")
                            <div class="form-check mt-2 mb-2">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{Illuminate\Support\Facades\DB::Table('respuestas')->where('pregunta_id','=',$examen[0]->id)->select('respuesta')->get()->first()->respuesta}}
                                    </label>
                                </div>
                                @for ($i = 0; $i < 3; $i++)
                                <div class="form-check mt-2 mb-2">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                        Respuesta {{$i}}
                                        </label>
                                    </div>
                                @endfor
                                @endif
                        @if($examen[0]->tipoPregunta=="falso_verdadero")
                        <div class="form-check mt-2 mb-2">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                <label class="form-check-label" for="exampleRadios1">
                               Falso
                                </label>
                            </div>
                            <div class="form-check mt-2 mb-2">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                    Verdadero
                                    </label>
                                </div>
                        @endif
                        @if($examen[0]->tipoPregunta=="abierta")
                        <label for="descripcion"></label>
                        <textarea class="form-control" rows="4" id="descripcion" name = "descripcion"></textarea>
                        <div class = "mt-5  text-center">
                                <a class="btn btn-primary" href="#" role="button">Guardar</a>    
                                </div>
                        @endif

                       
                        

                            
                    </div>
               
              </div>
              
            </div>
           
           <!-- <div class = "mt-5  text-center">
                    <a class="btn btn-primary" href="#" role="button">Siguiente</a>    
                    </div>-->
        </div>
        <div class = "mt-3 ml-6 row justify-content-center  ">
                {{$examen->links()}} 
             </div>
    </div> 
    </div>
        
</div>



@endsection