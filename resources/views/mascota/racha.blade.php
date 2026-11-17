@extends('layouts.app')

@section('title', 'PetTask - Racha de Actividad')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/racha-de-actividad.css') }}" />
@endsection

@section('content')
    <main class="contenido">
        <section class="encabezado">
            <h1 class="titulo">Racha de Actividad</h1>
            <p class="descripcion">
                Completa tus tareas para mantener e incrementar tu racha.
            </p>
        </section>
        <section class="card tarjeta-racha">
            <div class="racha-principal">
                <span class="racha-etiqueta">Racha actual</span>
                <span class="racha-valor">{{ $rachaActual ?? 7 }}</span>
                <span class="racha-unidad">tareas consecutivas</span>
            </div>
            <div class="mensaje-racha">
                <h2 class="subtitulo">¡Sigue así!</h2>
                <p>
                    Has completado {{ $rachaActual ?? 7 }} tareas seguidas. Completa otra tarea para aumentar tu racha.
                </p>
            </div>
        </section>
        <section class="card tarjeta-actividad">
            <h2 class="subtitulo">Tareas de la racha</h2>
            <ol class="tareas-racha" aria-label="Tareas completadas de la racha actual">
                <li class="tarea-racha completada">
                    <span class="tarea-numero">Tarea 1</span>
                    <span class="tarea-estado">Completada</span>
                </li>
                <li class="tarea-racha completada">
                    <span class="tarea-numero">Tarea 2</span>
                    <span class="tarea-estado">Completada</span>
                </li>
                <li class="tarea-racha completada">
                    <span class="tarea-numero">Tarea 3</span>
                    <span class="tarea-estado">Completada</span>
                </li>
                <li class="tarea-racha completada">
                    <span class="tarea-numero">Tarea 4</span>
                    <span class="tarea-estado">Completada</span>
                </li>
                <li class="tarea-racha completada">
                    <span class="tarea-numero">Tarea 5</span>
                    <span class="tarea-estado">Completada</span>
                </li>
                <li class="tarea-racha completada">
                    <span class="tarea-numero">Tarea 6</span>
                    <span class="tarea-estado">Completada</span>
                </li>
                <li class="tarea-racha completada">
                    <span class="tarea-numero">Tarea 7</span>
                    <span class="tarea-estado">Completada</span>
                </li>
            </ol>
        </section>
        <section class="card tarjeta-estadisticas">
            <h2 class="subtitulo">Resumen de actividad</h2>
            <div class="estadisticas">
                <div class="estadistica">
                    <span class="estadistica-valor">{{ $rachaActual ?? 7 }}</span>
                    <span class="estadistica-etiqueta">Racha actual (tareas)</span>
                </div>
                <div class="estadistica">
                    <span class="estadistica-valor">{{ $mejorRacha ?? 12 }}</span>
                    <span class="estadistica-etiqueta">Mejor racha (tareas)</span>
                </div>
            </div>
        </section>
    </main>
@endsection
