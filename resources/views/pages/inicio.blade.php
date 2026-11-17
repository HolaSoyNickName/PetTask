@extends('layouts.app')

@section('title', 'PetTask')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/estilos-sitio.css') }}" />
@endsection

@section('content')
    <main class="site-shell">
        <section class="site-header">
            <h1 class="site-title">
                <img src="{{ asset('img/logoInd.png') }}" alt=""
                    style="height: 1em; width: auto; vertical-align: -0.1em" />
                PetTask
            </h1>
            <p class="site-lede">
                Organiza tus tareas, mantén tu racha y cuida de tu mascota virtual.
            </p>
        </section>
        <section class="dashboard">
            <div class="dashboard-tareas">
                <div class="section-heading">
                    <h2>Mis actividades</h2>
                    <p>Administra tus tareas y mantén organizado tu espacio de estudio.</p>
                </div>
                <div class="site-feature-grid">
                    <a class="card site-feature" href="{{ route('resumen') }}">
                        <strong>Resumen general</strong>
                        <span>Consulta tus tareas, mascota y racha.</span>
                    </a>
                    <a class="card site-feature" href="{{ route('tareas.index') }}">
                        <strong>Ver tareas</strong>
                        <span>Busca actividades pendientes y completadas.</span>
                    </a>
                    <a class="card site-feature" href="{{ route('tareas.create') }}">
                        <strong>Agregar tarea</strong>
                        <span>Registra la siguiente actividad de estudio.</span>
                    </a>
                    <a class="card site-feature" href="{{ route('tareas.actualizar.vista') }}">
                        <strong>Actualizar tarea</strong>
                        <span>Modifica los datos de una actividad.</span>
                    </a>
                    <a class="card site-feature" href="{{ route('tareas.eliminar.vista') }}">
                        <strong>Eliminar tareas</strong>
                        <span>Administra tareas que ya no necesitas.</span>
                    </a>
                    <a class="card site-feature" href="{{ route('mascota.interaccion') }}">
                        <strong>Mascota virtual</strong>
                        <span>Revisa su estado y actividad.</span>
                    </a>
                    <a class="card site-feature" href="{{ route('mascota.tienda') }}">
                        <strong>Tienda de mascota</strong>
                        <span>Explora mejoras para tu compañera.</span>
                    </a>
                    <a class="card site-feature" href="{{ route('mascota.racha') }}">
                        <strong>Racha de actividad</strong>
                        <span>Visualiza tus tareas completadas consecutivamente.</span>
                    </a>
                    <a class="card site-feature" href="{{ route('recordatorios') }}">
                        <strong>Recordatorios</strong>
                        <span>Ten presentes tus próximas entregas.</span>
                    </a>
                </div>
            </div>
            <aside class="dashboard-lateral">
                <section class="card pet-card">
                    <div class="pet-card__header">
                        <div>
                            <p class="pet-card__eyebrow">Tu compañera</p>
                            <h2>Mascota virtual</h2>
                        </div>
                        <span class="pet-card__badge">PetTask</span>
                    </div>
                    <div class="pet-placeholder">
                        <div class="pet-placeholder__content">
                            <div class="pet-placeholder__icon">🐾</div>
                            <strong>Mascota virtual</strong>
                            <span>Próximamente</span>
                        </div>
                    </div>
                    <p class="pet-card__text">
                        Completa tus tareas para mantener a tu mascota feliz y con energía.
                    </p>
                    <a class="pet-card__link" href="{{ route('mascota.interaccion') }}">Ver mi mascota</a>
                </section>
                <section class="card streak-card">
                    <div class="streak-header">
                        <div>
                            <p class="streak-eyebrow">Constancia</p>
                            <h2>Racha de actividad</h2>
                        </div>
                        <span class="streak-icon">🔥</span>
                    </div>
                    <div class="streak-content">
                        <div class="streak-number">
                            <strong id="racha-actual-inicio">7</strong>
                            <span>tareas</span>
                        </div>
                        <div class="streak-info">
                            <strong>¡Sigue así!</strong>
                            <p>Completa tareas consecutivamente para aumentar tu racha.</p>
                        </div>
                    </div>
                    <a class="streak-link" href="{{ route('mascota.racha') }}">Ver mi racha</a>
                </section>
            </aside>
        </section>
    </main>
@endsection
