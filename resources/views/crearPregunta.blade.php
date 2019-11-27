@extends('layouts.app')

@section('content')
    
    <div class="row justify-content-md-end mt-5 pt-5" >
            <div class="col-sm-5  ">
                @include('plantillaCrearPregunta')
            </div>
            <div class="col-sm-7   ">
                @include('moduloPreguntasCreadas')
            </div>
    </div> 
    <br><br><br>
@endsection