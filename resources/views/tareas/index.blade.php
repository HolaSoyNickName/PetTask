@extends('layouts.app')

@section('title', 'PetTask - Ver Tareas')

@section('styles')
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/ver-tareas.css') }}" />
@endsection

@section('content')
    <main class="contenido">
        <section class="card tarjeta-tareas">
            <div class="encabezado-seccion">
                <h1 class="titulo">Mis Tareas</h1>
                <p class="descripcion">Consulta tus tareas pendientes y completadas.</p>
            </div>
            <div class="metricas-grid">
                <div class="tarjeta-metrica">
                    <span class="metrica-num" id="cnt-total">0</span>
                    <span class="metrica-lbl">Totales</span>
                </div>
                <div class="tarjeta-metrica">
                    <span class="metrica-num" id="cnt-pendientes">0</span>
                    <span class="metrica-lbl">Pendientes</span>
                </div>
                <div class="tarjeta-metrica">
                    <span class="metrica-num" id="cnt-completadas">0</span>
                    <span class="metrica-lbl">Completadas</span>
                </div>
            </div>
            <div class="barra-controles">
                <div class="grupo-filtros">
                    <button class="btn-filtro activo" onclick="filtrarTareas('todas', this)">
                        Todas
                    </button>
                    <button class="btn-filtro" onclick="filtrarTareas('pendiente', this)">
                        Pendientes
                    </button>
                    <button class="btn-filtro" onclick="filtrarTareas('completada', this)">
                        Completadas
                    </button>
                </div>
                <div class="caja-busqueda">
                    <i class="bi bi-search"></i>
                    <input type="text" id="inputBusqueda" class="form-control-custom"
                        placeholder="Buscar tarea o materia..." onkeyup="buscarTarea()" />
                </div>
            </div>
            <!-- Lista Interactiva de Tareas -->
            <div class="lista-tareas" id="listaTareas">
                @forelse($tareas ?? [] as $tarea)
                    <div class="tarea-item {{ ($tarea->estado ?? 'pendiente') === 'completada' ? 'completada' : '' }}"
                        data-estado="{{ $tarea->estado ?? 'pendiente' }}">
                        <div class="tarea-info">
                            <span class="materia-tag">{{ $tarea->materia }}</span>
                            <strong>{{ $tarea->tarea }}</strong>
                            <small>
                                <i class="bi bi-calendar3"></i>
                                {{ $tarea->descripcion ?? 'Sin fecha asignada' }}
                            </small>
                        </div>
                        <div class="tarea-acciones">
                            <button class="btn-estado btn-completar" onclick="cambiarEstadoTarea(this)">
                                <i class="bi bi-check2"></i>
                                Marcar completada
                            </button>
                        </div>
                    </div>
                @empty
                    <!-- Tarea 1 -->
                    <div class="tarea-item" data-estado="pendiente">
                        <div class="tarea-info">
                            <span class="materia-tag">Diseño de Interfaces</span>
                            <strong>Crear prototipos en Figma para el login</strong>
                            <small>
                                <i class="bi bi-calendar3"></i>
                                Entrega: 02/10/2026
                            </small>
                        </div>
                        <div class="tarea-acciones">
                            <button class="btn-estado btn-completar" onclick="cambiarEstadoTarea(this)">
                                <i class="bi bi-check2"></i>
                                Marcar completada
                            </button>
                        </div>
                    </div>
                    <!-- Tarea 2 -->
                    <div class="tarea-item" data-estado="pendiente">
                        <div class="tarea-info">
                            <span class="materia-tag">Programación POO</span>
                            <strong>Terminar diagrama de clases UML</strong>
                            <small>
                                <i class="bi bi-calendar3"></i>
                                Entrega: 30/09/2026
                            </small>
                        </div>
                        <div class="tarea-acciones">
                            <button class="btn-estado btn-completar" onclick="cambiarEstadoTarea(this)">
                                <i class="bi bi-check2"></i>
                                Marcar completada
                            </button>
                        </div>
                    </div>
                    <!-- Tarea 3 -->
                    <div class="tarea-item completada" data-estado="completada">
                        <div class="tarea-info">
                            <span class="materia-tag">Bases de Datos</span>
                            <strong>Migrar tablas e integrar procedimientos en MySQL</strong>
                            <small>
                                <i class="bi bi-check2-circle"></i>
                                Completada el: 22/09/2026
                            </small>
                        </div>
                        <div class="tarea-acciones">
                            <button class="btn-estado btn-deshacer" onclick="cambiarEstadoTarea(this)">
                                <i class="bi bi-arrow-counterclockwise"></i>
                                Deshacer
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>
            <!-- Estado vacío cuando no hay coincidencias -->
            <div class="estado-vacio" id="estadoVacio" style="display: none;">
                <i class="bi bi-search"></i>
                <p>No se encontraron tareas que coincidan con la búsqueda o filtro.</p>
            </div>
            <!-- Pie de la tarjeta -->
            <div class="pie-tarjeta">
                <a href="{{ route('tareas.create') }}" class="btn-rosa text-decoration-none d-inline-block">
                    <i class="bi bi-plus-lg"></i>
                    Agregar nueva tarea
                </a>
            </div>
        </section>
    </main>
@endsection
