<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#1e1e50" />
    <title>@yield('title', 'PetTask')</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <!-- Tipografías -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700&family=Questrial&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}" />
    <!-- CSS específico de cada vista -->
    @yield('styles')
</head>

<body>
    <!-- NAVBAR -->
    <header class="pet-nav navbar navbar-expand-lg navbar-dark">
        <a class="pet-nav__brand" href="{{ route('inicio') }}">
            <img src="{{ asset('img/logoNav.png') }}" alt="Logotipo de PetTask" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal"
            aria-controls="menuPrincipal" aria-expanded="false" aria-label="Abrir menú de navegación">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuPrincipal">
            <nav class="pet-nav__links navbar-nav ms-lg-auto" aria-label="Navegación principal">
                <a href="{{ route('inicio') }}" @if (request()->routeIs('inicio')) aria-current="page" @endif>Inicio</a>
                <a href="{{ route('nosotros') }}"
                    @if (request()->routeIs('nosotros')) aria-current="page" @endif>Nosotros</a>
                <a href="{{ route('servicios') }}"
                    @if (request()->routeIs('servicios')) aria-current="page" @endif>Servicios</a>
                <a href="{{ route('contacto') }}"
                    @if (request()->routeIs('contacto')) aria-current="page" @endif>Contacto</a>
                @auth
                    <div class="dropdown ms-lg-3">
                        <button class="user-menu-btn dropdown-toggle" type="button" id="menuUsuario"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @if (Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Foto de perfil"
                                    class="user-avatar-nav" />
                            @else
                                <span class="user-avatar-nav">
                                    {{ strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                                </span>
                            @endif
                            <span>{{ Auth::user()->name }}</span>
                            <i class="bi bi-chevron-down small"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end user-dropdown-menu" aria-labelledby="menuUsuario">
                            <div class="user-dropdown-header">
                                @if (Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Foto de perfil"
                                        class="user-dropdown-avatar" />
                                @else
                                    <div class="user-dropdown-avatar">
                                        {{ strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="overflow-hidden">
                                    <div class="user-dropdown-name text-truncate">{{ Auth::user()->name }}</div>
                                    <div class="user-dropdown-pet text-truncate">
                                        <i class="bi bi-heart-fill text-danger me-1"></i>
                                        Mascota: {{ Auth::user()->mascota_nombre ?? 'Firulais' }}
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('perfil.edit') }}" class="user-dropdown-item">
                                <span class="user-dropdown-icon"><i class="bi bi-person-gear"></i></span>
                                <span>Configuración y perfil</span>
                            </a>
                            <a href="{{ route('tareas.index') }}" class="user-dropdown-item">
                                <span class="user-dropdown-icon"><i class="bi bi-list-check"></i></span>
                                <span>Mis tareas</span>
                            </a>
                            <a href="{{ route('mascota.interaccion') }}" class="user-dropdown-item">
                                <span class="user-dropdown-icon"><i class="bi bi-stars"></i></span>
                                <span>Mi mascota virtual</span>
                            </a>

                            <hr class="my-2 opacity-25" />

                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="user-dropdown-item user-dropdown-item--danger">
                                    <span class="user-dropdown-icon"><i class="bi bi-box-arrow-right"></i></span>
                                    <span>Cerrar sesión</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a class="pet-nav__login" href="{{ route('login') }}">Iniciar sesión</a>
                @endauth
            </nav>
        </div>
    </header>

    @yield('content')

    <footer class="site-footer">
        PetTask · Aplicaciones Web · Septiembre–Diciembre 2026
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
