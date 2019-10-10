@extends('layouts.app')

@section('content')
<div class="container p-4 mt-5 shadow-sm rounded-lg bg-white " style="width: 35rem;">
    <!--<div class="row justify-content-center">
        <div class="col-md-8">--->
            <div class="card border-0">
                <div class="card-header  border-0 bg-white"><h1 class = "mt-1 h3 text-center">Iniciar Sesion</h1></div>

                <div class="card-body ">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="text-muted">{{ __('Correo electronico') }}</label>

                           <!-- <div class="col-md-6">-->
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <!--</div>-->
                        </div>

                        <div class="form-group ">
                            <label for="password" class="text-muted">{{ __('Contraseña') }}</label>

                            <!--<div class="col-md-6">-->
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <!--</div>-->
                        </div>

                        <div class="form-group ">
                            <!--<div class="col-md-6 offset-md-4">-->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                                </div>
                            <!--</div>-->
                        </div>

                        <div class="form-group ">
                            <!--<div class="col-md-8 offset-md-4">-->
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Iniciar Sesion') }}
                                </button>

                               
                            <!--</div>-->
                        </div>
                        <div class="form-group ">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link btn-block" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
    <!--        
        </div>
    </div>-->
</div>
@endsection
