@extends('layouts.app')

@section('title', 'Contacto - PetTask')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/estilos-sitio.css') }}" />
@endsection

@section('content')
    <!-- CONTENIDO -->
    <main class="contacto">
        <!-- HERO -->
        <section class="contacto-hero">
            <div class="contacto-hero__contenido">
                <p class="contacto-eyebrow">
                    Estamos para ayudarte
                </p>
                <h1 class="contacto-title">
                    Ponte en contacto con el equipo de PetTask.
                </h1>
                <p class="contacto-lede">
                    ¿Tienes alguna duda, comentario o sugerencia sobre
                    PetTask? Puedes comunicarte directamente con los
                    integrantes del equipo mediante sus correos
                    institucionales.
                </p>
            </div>
            <div class="contacto-hero__marca">
                <div class="contacto-logo-box">
                    <img src="{{ asset('img/logoInd.png') }}" alt="Logotipo de PetTask" />
                </div>
            </div>
        </section>
        <!-- CONTACTOS -->
        <section class="contacto-contenido">
            <div class="contacto-equipo">
                <div class="contacto-seccion__encabezado">
                    <p class="contacto-eyebrow">
                        Correos institucionales
                    </p>
                    <h2 class="contacto-section-title">
                        Contacta con nuestro equipo
                    </h2>
                    <p>
                        Selecciona cualquiera de los siguientes correos para
                        abrir directamente tu aplicación de correo.
                    </p>
                </div>
                <div class="contacto-lista">
                    <a class="contacto-card contacto-card--rosa" href="mailto:dec2007@micorreo.upp.edu.mx">
                        <div class="contacto-card__numero">
                            01
                        </div>
                        <div class="contacto-card__contenido">
                            <span>Líder</span>
                            <h3>
                                Diego Omar Espinoza Cuevas
                            </h3>
                            <p>
                                dec2007@micorreo.upp.edu.mx
                            </p>
                        </div>
                    </a>
                    <a class="contacto-card contacto-card--azul" href="mailto:josedanielnolascogomezpro3646@gmail.com">
                        <div class="contacto-card__numero">
                            02
                        </div>
                        <div class="contacto-card__contenido">
                            <span>Sublíder</span>
                            <h3>
                                Jose Daniel Nolasco Gómez
                            </h3>
                            <p>
                                josedanielnolascogomezpro3646@gmail.com
                            </p>
                        </div>
                    </a>
                    <a class="contacto-card contacto-card--rosa" href="mailto:angelalvarezdelvalle@micorreo.upp.edu.mx">
                        <div class="contacto-card__numero">
                            03
                        </div>
                        <div class="contacto-card__contenido">
                            <span>Integrante</span>
                            <h3>
                                Ángel Álvarez Del Valle
                            </h3>
                            <p>
                                angelalvarezdelvalle@micorreo.upp.edu.mx
                            </p>
                        </div>
                    </a>
                    <a class="contacto-card contacto-card--azul" href="mailto:angiedector01@micorreo.upp.edu.mx">
                        <div class="contacto-card__numero">
                            04
                        </div>
                        <div class="contacto-card__contenido">
                            <span>Integrante</span>
                            <h3>
                                Norma Angelica Dector Montiel
                            </h3>
                            <p>
                                angiedector01@micorreo.upp.edu.mx
                            </p>
                        </div>
                    </a>
                    <a class="contacto-card contacto-card--rosa" href="mailto:emir2007@micorreo.upp.edu.mx">
                        <div class="contacto-card__numero">
                            05
                        </div>
                        <div class="contacto-card__contenido">
                            <span>Integrante</span>
                            <h3>
                                Alexander Emir Sandoval Resendiz
                            </h3>
                            <p>
                                emir2007@micorreo.upp.edu.mx
                            </p>
                        </div>
                    </a>
                    <a class="contacto-card contacto-card--azul" href="mailto:Yaelhernandezcamargo@micorreo.upp.edu.mx">
                        <div class="contacto-card__numero">
                            06
                        </div>
                        <div class="contacto-card__contenido">
                            <span>Integrante</span>
                            <h3>
                                Brayan Yael Hernandez Camargo
                            </h3>
                            <p>
                                Yaelhernandezcamargo@micorreo.upp.edu.mx
                            </p>
                        </div>
                    </a>
                    <a class="contacto-card contacto-card--rosa" href="mailto:moc2531126199@micorreo.upp.edu.mx">
                        <div class="contacto-card__numero">
                            07
                        </div>
                        <div class="contacto-card__contenido">
                            <span>Integrante</span>
                            <h3>
                                Mariana Ordaz Cano
                            </h3>
                            <p>
                                moc2531126199@micorreo.upp.edu.mx
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <aside class="contacto-info">
                <div class="contacto-info__numero">
                    07
                </div>
                <p class="contacto-eyebrow">
                    PetTask
                </p>
                <h2>
                    Un proyecto pensado para organizar, avanzar y mantener la constancia.
                </h2>
                <p>
                    PetTask es un proyecto académico de Aplicaciones Web
                    enfocado en la organización de actividades, el seguimiento
                    del progreso y la motivación mediante una mascota virtual.
                </p>
                <a class="contacto-info__link" href="{{ route('nosotros') }}">
                    Conoce al equipo
                </a>
            </aside>
        </section>
    </main>
@endsection
