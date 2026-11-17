@extends('layouts.app')

@section('title', 'Iniciar Sesión - PetTask')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/iniciar-sesion.css') }}" />
@endsection

@section('content')
    <main class="contenido">
        <section class="card tarjeta-login">
            <h1 class="titulo">Iniciar Sesión</h1>
            <form action="{{ route('login') }}" method="POST" data-redirect="{{ route('inicio') }}">
                @csrf
                <div class="campo">
                    <label for="usuario" class="form-label"> Usuario </label>
                    <input type="text" class="form-control" id="usuario" name="usuario"
                        placeholder="Ingresa tu usuario" required />
                </div>
                <div class="campo">
                    <label for="contrasena" class="form-label"> Contraseña </label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena"
                        placeholder="Tu contraseña" required />
                </div>
                <div class="boton">
                    <button type="submit" class="btn-entrar">Entrar</button>
                </div>
                <div class="enlaces-login">
                    <p>¿No tienes cuenta? <a href="{{ route('registro') }}">Crear cuenta</a></p>
                </div>
            </form>
        </section>
    </main>
@endsection
