<!--Se llama a la plantilla principal ya creada-->
@extends('plantillas.portada')

@section('titulo')
<title>Login</title>
@vite(['resources/css/verLog.css', 'resources/js/verLog.js'])
@stop

@section('contenidoPrincipal')
<h3 class="fw-bold text-dark" style="text-align: center;">Login</h3>
<div class="container-fluid bg-secondary rounded-3 align-center p-3" style="width: 500px; margin-bottom: 15%;">
    @if(\Session::has('message'))
    <p class="alert alert-info">
        {{ \Session::get('message') }}
    </p>
    @endif
    <form id="formulario" action="{{ route('login') }}" method="post">
        @csrf
        <div id="grupo__role" class="formulario__grupo mb-3">
            <label class="formulario-label form-label fw-bold" for="">Rol</label><br>
            <div class="formulario__grupo-input">
                <select class="formulario__input form-control" id="role" name="role" value="{{ old('role') }}">
                    <option value="">Elige tu rol</option>
                    <option value="Empleado">Empleado</option>
                    <option value="Empleador">Empleador</option>
                    <option value="Admin">Administrador</option>
                </select>
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            @error('role')
            <br>
            <small style="color: white; font-weight: bold;">{{$message}}</small>
            @enderror
            <p class="formulario__input-error text-light fw-bold">Por favor, selecciona el rol de tu sesión.</p>
        </div>
        <div id="grupo__email" class="formulario__grupo mb-3">
            <label class="formulario-label form-label fw-bold" for="emailInput">Correo</label>
            <div class="formulario__grupo-input">
                <input id="email" name="email" class="formulario__input form-control" type="email" value="{{ old('email') }}">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            @error('email')
            <br>
            <small style="color: white; font-weight: bold;">{{$message}}</small>
            @enderror
            <p class="formulario__input-error text-light fw-bold">Por favor introduce un correo válido.</p>
        </div>
        <div id="grupo__password" class="formulario__grupo mb-3">
            <label class="formulario-label form-label fw-bold" for="passwordInput">Contraseña</label>
            <div class="formulario__grupo-input">
                <input id="password" name="password" class="formulario__input form-control" type="password" value="{{ old('password') }}">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            @error('password')
            <br>
            <small style="color: white; font-weight: bold;">{{$message}}</small>
            @enderror
            <!------Te haz quedado aquí-------->
            <p class="formulario__input-error fw-bold text-light">Por favor comprueba que tu contraseña cumple con 1 mayúscula, 1 minúscula, 1 número y 1 caracter especial, con una extensión de entre 8-20 caracteres.</p>
        </div>
        <div class="mb-3 form-check">
            <input id="rememberCheck" class="form-check-input" name="remember" type="checkbox">
            <label class="form-check-label" for="rememberCheck">Recuerdame...</label>
        </div>
        <div>
            <p>¿No tienes cuenta? <a class="text-light" href="/register"> Regístrate</a></p>
        </div>
        <div class="formulario__mensaje" id="formulario__mensaje">
            <p><i class="fas fa-exclamation-triangle" style="font-size: 15px;"></i> <b>Error:</b> Por favor, rellena el inicio de sesión correctamente. </p>
        </div>
        <div class="formulario__mensaje-exito bg-success round-3" id="formulario__mensaje-exito" style="height: 45px; line-height: 45px; background: #36e34d; padding: 0 15px; border-radius: 3px;">
            <p class="text-light fw-bold" style="font-size: 15px;">Iniciando Sesión...</p>
        </div>
        <br>
        <button class="btn btn-success" type="submit">Acceder</button>
        <a class="btn btn-dark" href="/">Volver</a>
        @if (Route::has('password.request'))
        <a class="btn btn-link text-light" href="{{ route('password.request') }}">
            Olvidaste tu contraseña?
        </a>
        @endif
    </form>
</div>
@stop
