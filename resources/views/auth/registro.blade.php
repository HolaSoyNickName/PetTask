@extends('layouts.app')

@section('title', 'Registrarse - PetTask')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}" />
@endsection

@section('content')
    <main class="contenido">
        <section class="card tarjeta-registro">
            <h1 class="titulo">Registrarse</h1>
            <form action="{{ route('registro') }}" method="POST" data-redirect="{{ route('login') }}">
                @csrf
                <div class="campo">
                    <label for="usuario" class="form-label"> Usuario </label>
                    <input type="text" class="form-control" id="usuario" name="usuario"
                        placeholder="Ingresa tu usuario" required />
                </div>
                <div class="campo">
                    <label for="contrasena" class="form-label"> Contraseña </label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena"
                        placeholder="Crea una contraseña" required />
                </div>
                <div class="campo">
                    <label for="confirmar-contrasena" class="form-label"> Confirmar contraseña </label>
                    <input type="password" class="form-control" id="confirmar-contrasena" name="contrasena_confirmation"
                        placeholder="Confirma tu contraseña" required />
                </div>
                <div class="boton">
                    <button type="submit" class="btn-registrarse">Crear cuenta</button>
                </div>
            </form>
        </section>
    </main>
@endsection
