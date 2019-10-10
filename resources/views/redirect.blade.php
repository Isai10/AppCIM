@extends('layouts.app')
@section('content')
    <?php
      header('Location: '. {{route('welcome')}});
      ?>
@endsection