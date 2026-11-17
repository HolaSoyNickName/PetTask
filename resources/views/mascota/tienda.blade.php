@extends('layouts.app')

@section('title', 'PetTask - Tienda de Mascota')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/tienda-de-mascota.css') }}" />
@endsection

@section('content')
    <main class="contenido">
        <section class="encabezado">
            <h1 class="titulo">Tienda de Mascota</h1>
            <p class="descripcion">
                Adquiere mejoras para tu mascota utilizando el saldo disponible.
            </p>
        </section>
        <section class="card saldo">
            <div>
                <span class="saldo-etiqueta">Saldo disponible</span>
                <span class="saldo-valor">{{ $saldo ?? 250 }}</span>
                <span class="saldo-puntos">puntos</span>
            </div>
        </section>
        <section class="tienda">
            <div class="card producto">
                <div class="producto-contenido">
                    <div class="producto-imagen">
                        <span>Mejora</span>
                    </div>
                    <h2 class="producto-titulo">Energía extra</h2>
                    <p class="producto-descripcion">
                        Aumenta la energía máxima de tu mascota.
                    </p>
                    <div class="producto-pie">
                        <span class="producto-precio">100 puntos</span>
                        <button type="button" class="btn-comprar">
                            Comprar
                        </button>
                    </div>
                </div>
            </div>
            <div class="card producto">
                <div class="producto-contenido">
                    <div class="producto-imagen">
                        <span>Mejora</span>
                    </div>
                    <h2 class="producto-titulo">Felicidad extra</h2>
                    <p class="producto-descripcion">
                        Aumenta la felicidad máxima de tu mascota.
                    </p>
                    <div class="producto-pie">
                        <span class="producto-precio">80 puntos</span>
                        <button type="button" class="btn-comprar">
                            Comprar
                        </button>
                    </div>
                </div>
            </div>
            <div class="card producto">
                <div class="producto-contenido">
                    <div class="producto-imagen">
                        <span>Mejora</span>
                    </div>
                    <h2 class="producto-titulo">Alimentación</h2>
                    <p class="producto-descripcion">
                        Mejora la recuperación de hambre de tu mascota.
                    </p>
                    <div class="producto-pie">
                        <span class="producto-precio">70 puntos</span>
                        <button type="button" class="btn-comprar">
                            Comprar
                        </button>
                    </div>
                </div>
            </div>
            <div class="card producto">
                <div class="producto-contenido">
                    <div class="producto-imagen">
                        <span>Mejora</span>
                    </div>
                    <h2 class="producto-titulo">Nivel de mascota</h2>
                    <p class="producto-descripcion">
                        Permite mejorar el nivel de tu mascota.
                    </p>
                    <div class="producto-pie">
                        <span class="producto-precio">150 puntos</span>
                        <button type="button" class="btn-comprar">
                            Comprar
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
