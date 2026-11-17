
@extends('layouts.app')

@section('title', 'Detalle de tarea | PetTask')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <a href="{{ route('tasks.index') }}" class="text-decoration-none">
            <i class="bi bi-arrow-left"></i> Volver a mis tareas
        </a>
    </div>

    <div class="pet-card mx-auto" style="max-width: 800px;">

        <div class="text-center mb-4">
            <div style="font-size: 65px;">
                🐾
            </div>

            <h1 class="fw-bold" style="color: #1E1E50;">
                Detalles de tu tarea
            </h1>

            <p class="text-muted">
                ¡Un paso más cerca de cuidar a tu mascota!
            </p>
        </div>

        <div class="p-3 rounded-4 mb-3" style="background-color: #E5EAF5;">
            <small class="text-muted fw-semibold">NOMBRE DE LA TAREA</small>
            <h3 class="mt-2 mb-0" style="color: #1E1E50;">
                {{ $task['title'] }}
            </h3>
        </div>

        <div class="p-3 rounded-4 mb-3" style="background-color: #E5EAF5;">
            <small class="text-muted fw-semibold">MATERIA</small>
            <h5 class="mt-2 mb-0" style="color: #1E1E50;">
                <i class="bi bi-book"></i>
                {{ $task['subject'] }}
            </h5>
        </div>

        <div class="p-3 rounded-4 mb-4" style="background-color: #E5EAF5;">
            <small class="text-muted fw-semibold">ESTADO</small>
            <div class="mt-2">
                @if($task['status'] == 'Completada')
                    <span class="badge rounded-pill bg-success p-2">
                        <i class="bi bi-check-circle"></i> Completada
                    </span>
                @else
                    <span class="badge rounded-pill p-2"
                          style="background-color: #FF6F82;">
                        <i class="bi bi-clock"></i> Pendiente
                    </span>
                @endif
            </div>
        </div>

        <div class="d-flex flex-wrap justify-content-center gap-2">
            <a href="{{ route('tasks.edit', $task['id']) }}"
               class="btn btn-pet-primary">
                <i class="bi bi-pencil-square"></i> Editar tarea
            </a>

            <a href="{{ route('tasks.index') }}"
               class="btn btn-outline-secondary">
                Volver a la lista
            </a>
        </div>

    </div>
</div>
@endsection
