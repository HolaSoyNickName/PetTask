@extends('layouts.app')

@section('title', 'Resumen General - PetTask')

@section('styles')
    <!-- Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/carga-de-datos-general.css') }}" />
@endsection

@section('content')
    <main class="contenido">
        <section class="card tarjeta-resumen">
            <h1 class="titulo">Resumen general</h1>
            <p class="descripcion">Consulta el estado general de tus tareas, mascota y racha.</p>
            <div class="resumen">
                <article class="card dato">
                    <div class="icono">
                        <i class="bi bi-check2-square"></i>
                    </div>
                    <div class="informacion">
                        <h2 class="subtitulo">Tareas</h2>
                        <div class="estadisticas">
                            <div class="estadistica">
                                <span class="valor" id="total-tareas">{{ $resumen['total_tareas'] ?? 0 }}</span>
                                <span class="texto">Total</span>
                            </div>
                            <div class="estadistica">
                                <span class="valor" id="tareas-pendientes">{{ $resumen['tareas_pendientes'] ?? 0 }}</span>
                                <span class="texto">Pendientes</span>
                            </div>
                            <div class="estadistica">
                                <span class="valor"
                                    id="tareas-completadas">{{ $resumen['tareas_completadas'] ?? 0 }}</span>
                                <span class="texto">Completadas</span>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="card dato">
                    <div class="icono">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <div class="informacion">
                        <h2 class="subtitulo">Mascota</h2>
                        <div class="estadisticas">
                            <div class="estadistica">
                                <span class="valor"
                                    id="nombre-mascota">{{ $resumen['nombre_mascota'] ?? 'Sin datos' }}</span>
                                <span class="texto">Nombre</span>
                            </div>
                            <div class="estadistica">
                                <span class="valor"
                                    id="estado-mascota">{{ $resumen['estado_mascota'] ?? 'Sin datos' }}</span>
                                <span class="texto">Estado</span>
                            </div>
                            <div class="estadistica">
                                <span class="valor" id="nivel-mascota">{{ $resumen['nivel_mascota'] ?? 0 }}</span>
                                <span class="texto">Nivel</span>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="card dato">
                    <div class="icono">
                        <i class="bi bi-fire"></i>
                    </div>
                    <div class="informacion">
                        <h2 class="subtitulo">Racha</h2>
                        <div class="estadisticas">
                            <div class="estadistica">
                                <span class="valor" id="racha-actual">{{ $resumen['racha_actual'] ?? 0 }}</span>
                                <span class="texto">Tareas consecutivas</span>
                            </div>
                            <div class="estadistica">
                                <span class="valor" id="mejor-racha">{{ $resumen['mejor_racha'] ?? 0 }}</span>
                                <span class="texto">Mejor racha (tareas)</span>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </main>
@endsection
