@extends('layouts.app')

@section('title', 'Eliminar Tareas - PetTask')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/eliminar-tareas.css') }}" />
@endsection

@section('content')
    <main class="contenido">
        <section class="card tarjeta-eliminar">
            <h1 class="titulo">Eliminar Tareas</h1>
            <p class="descripcion">
                Selecciona la tarea que deseas eliminar. El sistema te pedirá confirmación antes de borrarla.
            </p>
            <div class="alerta" role="alert">
                <strong>Importante:</strong>
                Recuerda que al eliminar una tarea, esta acción no se puede deshacer.
            </div>
            <div class="lista-tareas">
                @forelse($tareas ?? [] as $tarea)
                    <div class="tarea-item">
                        <div class="tarea-info">
                            <h2 class="tarea-titulo">{{ $tarea->materia }} - {{ $tarea->titulo }}</h2>
                            <p class="tarea-descripcion">{{ $tarea->descripcion ?? 'Sin descripción' }}</p>
                        </div>
                        <form action="{{ route('tareas.destroy', $tarea) }}" method="POST" id="form-eliminar-{{ $tarea->id }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id_tarea" value="{{ $tarea->id }}" />
                            <button type="button" class="btn-eliminar" data-bs-toggle="modal" data-bs-target="#confirmarEliminacion" data-formulario="form-eliminar-{{ $tarea->id }}">Eliminar</button>
                        </form>
                    </div>
                @empty
                    <div class="tarea-item">
                        <div class="tarea-info">
                            <h2 class="tarea-titulo">No hay tareas registradas</h2>
                            <p class="tarea-descripcion">Agrega una tarea primero para poder administrarla aquí.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="filtro">
                <h2 class="subtitulo">Filtrar tareas por materia</h2>
                <form class="formulario-filtro" method="GET" action="{{ route('tareas.eliminar.vista') }}">
                    <div class="campo-filtro">
                        <label for="filtroMateria" class="form-label"> Materia </label>
                        <input type="text" class="form-control" id="filtroMateria" name="materia"
                            value="{{ request('materia') }}"
                            placeholder="Escribe el nombre de la materia..." />
                    </div>
                    <button type="submit" class="btn-buscar">Buscar</button>
                </form>
            </div>
        </section>
    </main>

    <div class="modal fade" id="confirmarEliminacion" tabindex="-1" aria-labelledby="tituloConfirmacion" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="tituloConfirmacion">Confirmar eliminación</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">¿Seguro que deseas eliminar esta tarea? Esta acción no se puede deshacer.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmarEliminar">Eliminar tarea</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let formularioPendiente = null;
        const modalEliminacion = document.getElementById("confirmarEliminacion");
        modalEliminacion.addEventListener("show.bs.modal", (event) => {
            formularioPendiente = event.relatedTarget?.dataset.formulario ?? null;
        });
        document.getElementById("confirmarEliminar").addEventListener("click", () => {
            if (formularioPendiente) document.getElementById(formularioPendiente)?.requestSubmit();
        });
    </script>
@endsection