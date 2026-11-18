@extends('layouts.app')

@section('title', 'PetTask - Ver Tareas')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/ver-tareas.css') }}" />
    <style>
        .lista-tareas {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-top: 20px;
        }
        .tarea-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            padding: 18px 24px;
            border: 1.5px solid #8ea8f8;
            border-radius: 16px;
            background-color: #ffffff;
        }
        .tarea-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 6px;
        }
        .tarea-acciones {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        .btn-editar-guia {
            background-color: #8294f2;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 10px 18px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-editar-guia:hover {
            background-color: #6c7fe0;
            color: #ffffff;
        }
    </style>
@endsection

@section('content')
    @php
        $listaTareas = collect($tareas ?? []);
        $totalTareas = $listaTareas->count();
        $completadasCount = $listaTareas->filter(fn($t) => strtolower($t->estado ?? '') === 'completada')->count();
        $pendientesCount = $totalTareas - $completadasCount;
    @endphp

    <main class="contenido">
        <section class="card tarjeta-tareas">
            <div class="encabezado-seccion">
                <h1 class="titulo">Mis Tareas</h1>
                <p class="descripcion">Consulta tus tareas pendientes y completadas.</p>
            </div>
            <div class="metricas-grid">
                <div class="tarjeta-metrica">
                    <span class="metrica-num" id="cnt-total">{{ $totalTareas }}</span>
                    <span class="metrica-lbl">Totales</span>
                </div>
                <div class="tarjeta-metrica">
                    <span class="metrica-num" id="cnt-pendientes">{{ $pendientesCount }}</span>
                    <span class="metrica-lbl">Pendientes</span>
                </div>
                <div class="tarjeta-metrica">
                    <span class="metrica-num" id="cnt-completadas">{{ $completadasCount }}</span>
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
                @forelse($listaTareas as $tarea)
                    @php
                        $estadoNormalizado = strtolower($tarea->estado ?? 'pendiente') === 'completada' ? 'completada' : 'pendiente';
                    @endphp
                    <div class="tarea-item {{ $estadoNormalizado === 'completada' ? 'completada' : '' }}" data-estado="{{ $estadoNormalizado }}">
                        <div class="tarea-info">
                            <span class="materia-tag">{{ $tarea->materia }}</span>
                            <strong>{{ $tarea->titulo }}</strong>
                            <small>
                                <i class="bi bi-calendar3"></i>
                                {{ $tarea->descripcion ?? 'Sin descripción' }}
                            </small>
                        </div>
                        <div class="tarea-acciones">
                           <form action="{{ route('tareas.estado', $tarea) }}" method="POST" class="d-inline">
    @csrf
    @method('PATCH')
    <button type="submit" class="btn-estado {{ $estadoNormalizado === 'completada' ? 'btn-deshacer' : 'btn-completar' }}">
        <i class="bi {{ $estadoNormalizado === 'completada' ? 'bi-arrow-counterclockwise' : 'bi-check2' }}"></i>
        {{ $estadoNormalizado === 'completada' ? 'Deshacer' : 'Marcar completada' }}
    </button>
</form>
                            <a href="{{ route('tareas.edit', $tarea) }}" class="btn-editar-guia">
                                <i class="bi bi-pencil-square"></i>
                                Actualizar
                            </a>
                            <a href="{{ route('tareas.eliminar.vista') }}" class="btn-estado btn-completar text-decoration-none">
                                <i class="bi bi-trash3"></i>
                                Eliminar
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="tarea-item">
                        <div class="tarea-info">
                            <span class="materia-tag">Sin tareas</span>
                            <strong>Aún no has registrado tareas</strong>
                            <small>Haz clic en Agregar nueva tarea para comenzar.</small>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="estado-vacio" id="estadoVacio" style="display: none;">
                <i class="bi bi-search"></i>
                <p>No se encontraron tareas que coincidan con la búsqueda o filtro.</p>
            </div>

            <div class="pie-tarjeta mt-4">
                <a href="{{ route('tareas.create') }}" class="btn-rosa text-decoration-none d-inline-block">
                    <i class="bi bi-plus-lg"></i>
                    Agregar nueva tarea
                </a>
            </div>
        </section>
    </main>
@endsection