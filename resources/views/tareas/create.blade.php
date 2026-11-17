@extends('layouts.app')

@section('title', 'Agregar Tarea - PetTask')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/agregar-tareas.css') }}" />
@endsection

@section('content')
    <main class="contenido">
        <section class="card tarjeta-formulario">
            <h1 class="titulo">Agregar Tarea</h1>
            <form action="{{ route('tareas.store') }}" method="POST">
                @include('tareas._form', ['btnText' => 'Guardar tarea'])
            </form>
        </section>
    </main>
@endsection
