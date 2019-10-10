@extends('layouts.app')

@section('content')
<div class="container p-4  shadow-sm  mt-5 rounded bg-white " style="width: 35rem;">
    <!--<div class="row justify-content-center">
        <div class="col-md-8">-->
            <div class="card border-0">
                <div class="card-header bg-white border-0"><h1 class = "mt-1 h3 text-center">Registrarme</h1></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="text-muted">{{ __('Nombre') }}</label>

                            <!--<div class="col-md-6">-->
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <!--</div>-->
                        </div>

                        <div class="form-group ">
                            <label for="email" class="text-muted">{{ __('Correo electronico') }}</label>

                           <!-- <div class="col-md-6">-->
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <!--</div>-->
                        </div>

                        <div class="form-group">
                            <label for="password" class="text-muted">{{ __('Contraseña') }}</label>

                            <!--<div class="col-md-6">-->
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <!--</div>-->
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="text-muted">{{ __('Confrimar contraseña') }}</label>

                           <!-- <div class="col-md-6">-->
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            <!--</div>-->
                        </div>

                        <div class="form-group">
                            
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Registrarme') }}
                                </button>
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
