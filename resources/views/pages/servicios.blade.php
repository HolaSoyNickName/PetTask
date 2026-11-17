@extends('layouts.app')

@section('title', 'Servicios - PetTask')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
@endsection

@section('content')
    <main class="site-shell">
        <p class="site-eyebrow">Espacio de trabajo</p>
        <h1 class="site-title">Herramientas para tu rutina de estudio.</h1>
        <p class="site-lede">Abre una sección de PetTask para consultar tu resumen, gestionar actividades o revisar el
            progreso de tu mascota.</p>
        <div class="site-feature-grid">
            <a class="card site-feature" href="{{ route('resumen') }}"><strong>Resumen general</strong><span>Tareas, mascota y
                    racha en una vista.</span></a>
            <a class="card site-feature" href="{{ route('tareas.index') }}"><strong>Ver tareas</strong><span>Consulta, busca
                    y filtra actividades.</span></a>
            <a class="card site-feature" href="{{ route('tareas.create') }}"><strong>Agregar tareas</strong><span>Registra
                    una nueva actividad académica.</span></a>
            <a class="card site-feature" href="{{ route('tareas.actualizar.vista') }}"><strong>Actualizar
                    tarea</strong><span>Edita los datos de una tarea existente.</span></a>
            <a class="card site-feature" href="{{ route('tareas.eliminar.vista') }}"><strong>Eliminar
                    tareas</strong><span>Administra las actividades que ya no necesitas.</span></a>
            <a class="card site-feature" href="{{ route('mascota.interaccion') }}"><strong>Mascota
                    virtual</strong><span>Consulta su estado y actividad.</span></a>
            <a class="card site-feature" href="{{ route('mascota.tienda') }}"><strong>Tienda de mascota</strong><span>Revisa
                    las mejoras disponibles.</span></a>
            <a class="card site-feature" href="{{ route('mascota.racha') }}"><strong>Racha de
                    actividad</strong><span>Consulta tus tareas completadas consecutivamente.</span></a>
            <a class="card site-feature" href="{{ route('recordatorios') }}"><strong>Recordatorios</strong><span>Revisa las
                    próximas fechas importantes.</span></a>
            <a class="card site-feature" href="{{ route('login') }}"><strong>Iniciar sesión</strong><span>Accede con tu
                    cuenta.</span></a>
            <a class="card site-feature" href="{{ route('registro') }}"><strong>Registrarse</strong><span>Crea una cuenta
                    nueva.</span></a>
        </div>
    </main>
@endsection
