@extends('layouts.app')

@section('content')
    <div class="row justify-content-md-end" >
            <div class="col-sm-5  ">
                @include('plantillaCrearPregunta')
            </div>
            <div class="col-sm-7   ">
                @include('moduloPreguntasCreadas')
            </div>
    </div> 
@endsection