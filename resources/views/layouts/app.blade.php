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
                    <div class="d-flex align-items-center gap-2 ms-lg-3">
                        <span class="badge rounded-pill px-3 py-2 d-inline-flex align-items-center gap-2"
                            style="background: rgba(130, 148, 242, 0.25); border: 1px solid #8ea8f8; color: #ffffff; font-size: 0.9rem;">
                            <i class="bi bi-person-circle"></i>
                            {{ Auth::user()->name }}
                        </span>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline m-0">
                            @csrf
                            <button type="submit" class="btn btn-sm rounded-pill px-3"
                                style="background-color: #ff6b81; color: #ffffff; border: none; font-weight: 600;">
                                Salir
                            </button>
                        </form>
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
