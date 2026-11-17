@extends('layouts.app')

@section('title', 'Editar tarea | PetTask')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <a href="{{ route('tasks.index') }}" class="text-decoration-none">
            <i class="bi bi-arrow-left"></i> Volver a mis tareas
        </a>
    </div>

    <div class="pet-card mx-auto" style="max-width: 750px;">
        <div class="mb-4">
            <h1 class="fw-bold" style="color: #1E1E50;">
                <i class="bi bi-pencil-square"></i> Editar tarea
            </h1>
            <p class="text-muted">
                Actualiza la información de tu tarea escolar.
            </p>
        </div>

        <form action="{{ route('tasks.update', $task['id']) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <!-- Título -->
            <div class="mb-3">
                <label for="title" class="form-label fw-semibold">
                    Nombre o título de la tarea <span class="text-danger">*</span>
                </label>
                <input
                    type="text"
                    class="form-control @error('title') is-invalid @enderror"
                    id="title"
                    name="title"
                    value="{{ old('title', $task['title']) }}"
                    placeholder="Ej. Investigar sobre la fotosíntesis"
                >
                @error('title')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Materia -->
            <div class="mb-3">
                <label for="subject" class="form-label fw-semibold">
                    Materia <span class="text-danger">*</span>
                </label>
                <input
                    type="text"
                    class="form-control @error('subject') is-invalid @enderror"
                    id="subject"
                    name="subject"
                    value="{{ old('subject', $task['subject']) }}"
                    placeholder="Ej. Biología"
                >
                @error('subject')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Estado -->
            <div class="mb-4">
                <label for="status" class="form-label fw-semibold">
                    Estado de la tarea <span class="text-danger">*</span>
                </label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                    <option value="Pendiente"
                        {{ old('status', $task['status']) == 'Pendiente' ? 'selected' : '' }}>
                        Pendiente
                    </option>
                    <option value="Completada"
                        {{ old('status', $task['status']) == 'Completada' ? 'selected' : '' }}>
                        Completada
                    </option>
                </select>
                @error('status')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Descripción (opcional) -->
            <div class="mb-4">
                <label for="description" class="form-label fw-semibold">
                    Descripción de la tarea (opcional)
                </label>
                <textarea
                    class="form-control @error('description') is-invalid @enderror"
                    id="description"
                    name="description"
                    rows="3"
                    placeholder="Escribe una descripción o detalles adicionales sobre la tarea..."
                >{{ old('description', $task['description'] ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-pet-primary">
                    <i class="bi bi-check-circle"></i> Guardar cambios
                </button>

                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
