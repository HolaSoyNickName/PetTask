
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'PetTask')</title>

    <!-- Tipografías oficiales -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700&family=Questrial&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --pet-background: #E5EAF5;
            --pet-white: #FFFFFF;
            --pet-pink: #FF6F82;
            --pet-light-blue: #8FA3ED;
            --pet-blue: #557FFC;
            --pet-navy: #1E1E50;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background-color: var(--pet-background);
            color: var(--pet-navy);
            font-family: 'Onest', sans-serif;
            font-size: 16px;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Questrial', sans-serif;
            color: var(--pet-navy);
        }

        .navbar-pettask {
            background-color: var(--pet-white);
            min-height: 76px;
            box-shadow: 0 2px 10px rgba(30, 30, 80, 0.08);
        }

        .brand-pettask {
            color: var(--pet-navy);
            font-family: 'Questrial', sans-serif;
            font-size: 28px;
            text-decoration: none;
        }

        .brand-pettask i {
            color: var(--pet-pink);
        }

        .nav-link-pettask {
            color: var(--pet-navy);
            text-decoration: none;
            padding: 12px 16px;
            min-height: 45px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 12px;
            font-weight: 500;
        }

        .nav-link-pettask:hover,
        .nav-link-pettask.active {
            color: var(--pet-blue);
            background-color: var(--pet-background);
        }

        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px;
            min-height: calc(100vh - 150px);
        }

        .pet-card {
            background-color: var(--pet-white);
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 3px 12px rgba(30, 30, 80, 0.07);
        }

        .btn-pet-primary {
            background-color: var(--pet-blue);
            color: white;
            border: none;
            border-radius: 12px;
            min-height: 45px;
            padding: 10px 20px;
            font-family: 'Onest', sans-serif;
            font-weight: 500;
        }

        .btn-pet-primary:hover {
            background-color: var(--pet-navy);
            color: white;
        }

        .btn-pet-pink {
            background-color: var(--pet-pink);
            color: white;
            border: none;
            border-radius: 12px;
            min-height: 45px;
            padding: 10px 20px;
        }

        .btn-pet-pink:hover {
            background-color: #e95770;
            color: white;
        }

        .footer-pettask {
            text-align: center;
            padding: 20px;
            color: var(--pet-navy);
            font-size: 14px;
        }

        @media (max-width: 576px) {
            .main-container {
                padding: 16px;
            }

            .brand-pettask {
                font-size: 24px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-pettask">
        <div class="container">

            <a class="brand-pettask" href="{{ route('tasks.index') }}">
                <i class="bi bi-paw-fill"></i> PetTask
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarPetTask"
                    aria-controls="navbarPetTask"
                    aria-expanded="false"
                    aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarPetTask">

                <div class="navbar-nav ms-auto gap-2 mt-3 mt-lg-0">

                    <a class="nav-link-pettask" href="{{ route('tasks.index') }}">
                        <i class="bi bi-house-door"></i>
                        Inicio
                    </a>

                    <a class="nav-link-pettask" href="{{ route('tasks.create') }}">
                        <i class="bi bi-plus-circle"></i>
                        Nueva tarea
                    </a>

                </div>
            </div>

        </div>
    </nav>

    <!-- Contenido de cada pantalla -->
    <main class="main-container">
        @yield('content')
    </main>

    <!-- Pie de página -->
    <footer class="footer-pettask">
        <i class="bi bi-paw-fill"></i>
        PetTask | Organiza tus tareas, mantén tu racha y cuida a tu mascota.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
