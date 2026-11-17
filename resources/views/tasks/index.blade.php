
@extends('layouts.app')

@section('title', 'Inicio | PetTask')

@section('content')

@php
    $completedTasks = collect($tasks)->where('status', 'Completada')->count();
    $pendingTasks = count($tasks) - $completedTasks;
@endphp

<div class="mb-4">
    <h1 class="fw-bold">¡Bienvenido a PetTask! 🐾</h1>
    <p class="text-muted">
        Organiza tus actividades y avanza junto a tu mascota.
    </p>
</div>

@if(session('success'))
    <div class="alert alert-success rounded-3">
        {{ session('success') }}
    </div>
@endif

<!-- Mascota y racha -->
<div class="row g-3 mb-4">

    <div class="col-md-6">
        <div class="pet-card d-flex align-items-center gap-3">
            <div style="font-size: 65px;">🐱</div>
            <div>
                <h3 class="mb-1">Tu compañero</h3>
                <p class="text-muted mb-2">
                    ¡Tu mascota está lista para acompañarte!
                </p>
                <span class="badge rounded-pill"
                      style="background: #8FA3ED;">
                    Mascota inicial
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="pet-card text-center">
            <h3>🔥 Tu racha</h3>
            <div class="fs-1 fw-bold" style="color: #557FFC;">
                🌱
            </div>
            <p class="mb-0 text-muted">
                ¡Comienza tu aventura!
            </p>
            <small class="text-muted">
                Sistema de rachas pendiente de integración.
            </small>
        </div>
    </div>

</div>

<!-- Estadísticas -->
<div class="row g-3 mb-4">

    <div class="col-4">
        <div class="pet-card text-center">
            <i class="bi bi-journal-text fs-3"
               style="color: #557FFC;"></i>
            <h2 class="fw-bold mt-2">{{ count($tasks) }}</h2>
            <small>Total de tareas</small>
        </div>
    </div>

    <div class="col-4">
        <div class="pet-card text-center">
            <i class="bi bi-check-circle fs-3 text-success"></i>
            <h2 class="fw-bold mt-2">{{ $completedTasks }}</h2>
            <small>Completadas</small>
        </div>
    </div>

    <div class="col-4">
        <div class="pet-card text-center">
            <i class="bi bi-clock-history fs-3"
               style="color: #FF6F82;"></i>
            <h2 class="fw-bold mt-2">{{ $pendingTasks }}</h2>
            <small>Pendientes</small>
        </div>
    </div>

</div>

<!-- Tabla de tareas -->
<div class="pet-card">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="mb-1">Mis tareas escolares</h2>
            <p class="text-muted mb-0">
                Consulta y administra tus actividades.
            </p>
        </div>

        <a href="{{ route('tasks.create') }}"
           class="btn btn-pet-primary">
            <i class="bi bi-plus-circle"></i>
            Nueva tarea
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Materia</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse($tasks as $task)

                    <tr>
                        <td>{{ $task['id'] }}</td>

                        <td class="fw-semibold">
                            {{ $task['title'] }}
                        </td>

                        <td>{{ $task['subject'] }}</td>

                        <td>
                            @if($task['status'] == 'Completada')
                                <span class="badge bg-success">
                                    Completada
                                </span>
                            @else
                                <span class="badge"
                                      style="background: #8FA3ED;">
                                    Pendiente
                                </span>
                            @endif
                        </td>

                        <td>
                            <div class="d-flex gap-2 flex-wrap">

                                <!-- Ver -->
                                <a href="{{ route('tasks.show', $task['id']) }}"
                                   class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i> Ver
                                </a>

                                <!-- Editar -->
                                <a href="{{ route('tasks.edit', $task['id']) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>

                                <!-- Botón Borrar -->
                                <button type="button"
                                        class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteTaskModal{{ $task['id'] }}">
                                    <i class="bi bi-trash"></i> Borrar
                                </button>

                            </div>
                        </td>
                    </tr>

                    <!-- Modal personalizado para eliminar -->
                    <div class="modal fade"
                         id="deleteTaskModal{{ $task['id'] }}"
                         tabindex="-1"
                         aria-labelledby="deleteTaskLabel{{ $task['id'] }}"
                         aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content border-0 rounded-4 shadow">

                                <div class="modal-body text-center p-4">

                                    <!-- Icono -->
                                    <div class="mb-3"
                                         style="font-size: 65px;">
                                        🐾
                                    </div>

                                    <!-- Titulo -->
                                    <h4 class="fw-bold mb-3"
                                        id="deleteTaskLabel{{ $task['id'] }}"
                                        style="color: #1E1E50;">
                                        ¿Eliminar esta tarea?
                                    </h4>

                                    <!-- Mensaje -->
                                    <p class="text-muted mb-3">
                                        ¡Oh, no! Tu tarea está a punto de desaparecer.
                                        ¿Estás seguro de que deseas eliminarla?
                                    </p>

                                    <div class="rounded-3 p-3 mb-4"
                                         style="background-color: #E5EAF5;">
                                        <strong style="color: #1E1E50;">
                                            {{ $task['title'] }}
                                        </strong>
                                        <br>
                                        <small class="text-muted">
                                            {{ $task['subject'] }}
                                        </small>
                                    </div>

                                    <!-- Botones -->
                                    <div class="d-flex justify-content-center flex-wrap gap-2">

                                        <button type="button"
                                                class="btn rounded-pill px-4"
                                                style="background-color: #E5EAF5; color: #1E1E50;"
                                                data-bs-dismiss="modal">
                                            ¡No, conservar!
                                        </button>

                                        <form action="{{ route('tasks.destroy', $task['id']) }}"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn rounded-pill px-4 text-white"
                                                    style="background-color: #FF6F82;">
                                                <i class="bi bi-trash"></i>
                                                Sí, eliminar
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                @empty

                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="bi bi-journal-plus fs-1"
                               style="color: #8FA3ED;"></i>

                            <h4 class="mt-3">¡Aún no tienes tareas!</h4>

                            <p class="text-muted">
                                Agrega tu primera actividad para comenzar.
                            </p>

                            <a href="{{ route('tasks.create') }}"
                               class="btn btn-pet-primary">
                                Crear mi primera tarea
                            </a>
                        </td>
                    </tr>

                @endforelse

            </tbody>
        </table>
    </div>

</div>

@endsection
