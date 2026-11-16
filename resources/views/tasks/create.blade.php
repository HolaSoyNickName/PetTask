@extends('layouts.app')

@section('title', 'Nueva tarea | PetTask')

@section('content')

<div class="mb-4">
    <h1>Crear nueva tarea</h1>
    <p class="text-muted">
        Registra tus actividades escolares y organiza tu tiempo.
    </p>
</div>

<div class="pet-card">

    <form action="{{ route('tasks.store') }}" method="POST" novalidate>
        @csrf

        <!-- Título -->
        <div class="mb-4">
            <label for="title" class="form-label fw-semibold">
                <i class="bi bi-pencil-square"></i>
                Título de la tarea <span class="text-danger">*</span>
            </label>

            <input
                type="text"
                class="form-control @error('title') is-invalid @enderror"
                id="title"
                name="title"
                value="{{ old('title') }}"
                placeholder="Ej. Investigar sobre la Revolución Mexicana"
                style="min-height: 56px;"
            >

            @error('title')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Materia -->
        <div class="mb-4">
            <label for="subject" class="form-label fw-semibold">
                <i class="bi bi-book"></i>
                Materia <span class="text-danger">*</span>
            </label>

            <input
                type="text"
                class="form-control @error('subject') is-invalid @enderror"
                id="subject"
                name="subject"
                value="{{ old('subject') }}"
                placeholder="Ej. Historia, Matemáticas, Programación..."
                style="min-height: 56px;"
            >

            @error('subject')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Estado -->
        <div class="mb-4">
            <label for="status" class="form-label fw-semibold">
                <i class="bi bi-check-circle"></i>
                Estado de la tarea <span class="text-danger">*</span>
            </label>

            <select
                class="form-select @error('status') is-invalid @enderror"
                id="status"
                name="status"
                style="min-height: 56px;"
            >
                <option value="Pendiente"
                    {{ old('status', 'Pendiente') == 'Pendiente' ? 'selected' : '' }}>
                    Pendiente
                </option>

                <option value="Completada"
                    {{ old('status') == 'Completada' ? 'selected' : '' }}>
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
                <i class="bi bi-card-text"></i>
                Descripción de la tarea (opcional)
            </label>

            <textarea
                class="form-control @error('description') is-invalid @enderror"
                id="description"
                name="description"
                rows="3"
                placeholder="Escribe una descripción o detalles adicionales sobre la tarea..."
            >{{ old('description') }}</textarea>

            @error('description')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botones -->
        <div class="d-flex gap-2 flex-wrap mt-4">

            <button type="submit" class="btn btn-pet-primary">
                <i class="bi bi-plus-circle"></i>
                Guardar tarea
            </button>

            <a href="{{ route('tasks.index') }}"
               class="btn btn-outline-secondary d-flex align-items-center">
                <i class="bi bi-arrow-left me-2"></i>
                Regresar
            </a>

        </div>

    </form>

</div>

@endsection
