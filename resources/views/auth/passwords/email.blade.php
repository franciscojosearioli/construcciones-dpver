@extends('layouts.app')
@section('content')
<div class="d-lg-flex half">
    <div class="bg order-1 order-md-2 ocultar-div" style="background-image: url('../images/fondo.jpg');"></div>
    <div class="contents order-2 order-md-1">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <h3>Recupera tu contraseña</h3>
            <p class="mb-4">Ingresa tu correo para crear una nueva clave.</p>
            @if (session('status'))
           <div class="alert alert-success">
           {{ session('status') }}
           </div>
            @endif
            <form method="post" action="{{ route('password.email') }}">
            {{ csrf_field() }}
              <div class="form-group first">
                <label for="email">Correo electronico</label>
                <input type="email" class="form-control" placeholder="ejemplo@email.com" name="email" id="email"  disabled>
                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
              </div>

              <div class="d-flex mb-5 align-items-center">
              <span class="ml-auto"><a href="{{ route('login') }}" class="forgot-pass">Volver a iniciar sesion</a></span>
              </div>
              <input type="submit" value="Recuperar" class="btn btn-block btn-dark2">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
