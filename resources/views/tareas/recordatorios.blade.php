@extends('layouts.app')

@section('title', 'PetTask - Recordatorios')

@section('styles')
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/ver-tareas.css') }}" />
    @if (file_exists(public_path('css/recordatorios.css')))
        <link rel="stylesheet" href="{{ asset('css/recordatorios.css') }}" />
    @endif
@endsection

@section('content')
    <main class="contenido">
        <section class="card tarjeta-tareas">
            <div class="encabezado-seccion">
                <h1 class="titulo">Recordatorios</h1>
                <p class="descripcion">Ten presentes tus próximas entregas y actividades programadas.</p>
            </div>

            <div class="lista-tareas" id="listaRecordatorios">
                @forelse($recordatorios ?? [] as $recordatorio)
                    <div class="tarea-item">
                        <div class="tarea-info">
                            <span class="materia-tag">{{ $recordatorio->materia }}</span>
                            <strong>{{ $recordatorio->tarea }}</strong>
                            <small>
                                <i class="bi bi-alarm"></i>
                                Fecha límite: {{ $recordatorio->fecha_limite ?? 'Próximamente' }}
                            </small>
                        </div>
                        <div class="tarea-acciones">
                            <a href="{{ route('tareas.index') }}" class="btn-estado btn-completar text-decoration-none">
                                <i class="bi bi-eye"></i>
                                Ver tarea
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="tarea-item">
                        <div class="tarea-info">
                            <span class="materia-tag">Programación POO</span>
                            <strong>Terminar diagrama de clases UML</strong>
                            <small>
                                <i class="bi bi-alarm"></i>
                                Entrega próxima: 30/09/2026
                            </small>
                        </div>
                        <div class="tarea-acciones">
                            <a href="{{ route('tareas.index') }}" class="btn-estado btn-completar text-decoration-none">
                                <i class="bi bi-eye"></i>
                                Ver tarea
                            </a>
                        </div>
                    </div>

                    <div class="tarea-item">
                        <div class="tarea-info">
                            <span class="materia-tag">Diseño de Interfaces</span>
                            <strong>Crear prototipos en Figma para el login</strong>
                            <small>
                                <i class="bi bi-alarm"></i>
                                Entrega próxima: 02/10/2026
                            </small>
                        </div>
                        <div class="tarea-acciones">
                            <a href="{{ route('tareas.index') }}" class="btn-estado btn-completar text-decoration-none">
                                <i class="bi bi-eye"></i>
                                Ver tarea
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="pie-tarjeta">
                <a href="{{ route('tareas.create') }}" class="btn-rosa text-decoration-none d-inline-block">
                    <i class="bi bi-plus-lg"></i>
                    Programar nueva tarea
                </a>
            </div>
        </section>
    </main>
@endsection
