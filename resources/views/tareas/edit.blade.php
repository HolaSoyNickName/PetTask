@extends('layouts.app')

@section('title', 'Actualizar Tarea - PetTask')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/actualizar-tarea.css') }}" />
@endsection

@section('content')
    @php
        $tareaActual = $tarea ?? ($tareas->first() ?? null);
    @endphp
    <main class="contenido">
        <section class="tarjeta-formulario">
            <h1 class="titulo">Actualizar Tarea</h1>
            <p class="descripcion">Modifica los datos de la tarea seleccionada y guarda los cambios.</p>

            <div id="alerta" class="alerta {{ session('success') ? '' : 'd-none' }}" role="alert">
                {{ session('success') ?? '¡Los cambios de la tarea se guardaron correctamente!' }}
            </div>

            @if($tareaActual)
                <form id="formActualizarTarea" action="{{ route('tareas.update', $tareaActual) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('tareas._form', ['modo' => 'actualizar', 'tarea' => $tareaActual])
                </form>
            @else
                <div class="alerta" role="alert">
                    No hay tareas registradas todavía. <a href="{{ route('tareas.create') }}">Agrega una tarea aquí</a>.
                </div>
            @endif
        </section>
    </main>
@endsection