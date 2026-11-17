@extends('layouts.app')

@section('title', 'Actualizar Tarea - PetTask')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/actualizar-tarea.css') }}" />
@endsection

@section('content')
    <main class="contenido">
        <section class="tarjeta-formulario">
            <h1 class="titulo">Actualizar Tarea</h1>
            <p class="descripcion">Modifica los datos de la tarea seleccionada y guarda los cambios.</p>

            <div id="alerta" class="alerta {{ session('success') ? '' : 'd-none' }}" role="alert">
                {{ session('success') ?? '¡Los cambios de la tarea se guardaron correctamente!' }}
            </div>

            <form action="{{ isset($tarea) && $tarea->id ? route('tareas.update', $tarea) : '#' }}" method="POST">
                @if (isset($tarea) && $tarea->id)
                    @method('PUT')
                @endif

                @include('tareas._form', ['modo' => 'actualizar'])
            </form>
        </section>
    </main>
@endsection
