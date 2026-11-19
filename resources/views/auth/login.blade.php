@extends('layouts.app')

@section('title', 'Iniciar Sesión - PetTask')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/estilos-sitio.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/auth-futurista.css') }}" />
@endsection

@section('content')
    <main class="auth-stage">
        <div class="auth-card-wrapper {{ $errors->any() ? 'has-error' : '' }}">
            <section class="auth-card">
                <h1 class="auth-titulo">Iniciar Sesión</h1>

                <form id="formLogin" action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <div class="auth-campo">
                        <label for="usuario">Usuario</label>
                        <input type="text" id="usuario" name="usuario" class="auth-input" value="{{ old('usuario') }}"
                            placeholder="Ingresa tu usuario" required autofocus />
                        @error('usuario')
                            <span class="auth-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-campo">
                        <label for="password">Contraseña</label>
                        <div class="auth-input-wrap">
                            <input type="password" id="password" name="password" class="auth-input auth-input--password"
                                placeholder="Tu contraseña" required />
                            <button type="button" class="auth-toggle-pass" onclick="togglePassword('password', this)"
                                aria-label="Mostrar u ocultar contraseña">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="auth-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="auth-btn">Entrar</button>
                </form>

                <p class="auth-pie">
                    ¿No tienes cuenta? <a href="{{ route('registro') }}">Crear cuenta</a>
                </p>

                <div class="auth-hud" id="authHud" aria-live="polite">
                    <div class="hud-orbita">
                        <div class="hud-anillo"></div>
                        <div class="hud-anillo-interno"></div>
                        <i class="bi bi-shield-lock hud-icono"></i>
                    </div>
                    <div class="hud-texto" id="hudTexto">Verificando credenciales...</div>
                    <div class="hud-barra">
                        <div class="hud-barra-progreso"></div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            const oculta = input.type === 'password';
            input.type = oculta ? 'text' : 'password';
            icon.className = oculta ? 'bi bi-eye-slash' : 'bi bi-eye';
        }

        document.getElementById('formLogin').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const hud = document.getElementById('authHud');
            const texto = document.getElementById('hudTexto');

            hud.classList.add('activo');
            setTimeout(() => {
                texto.textContent = 'Sincronizando perfil PetTask...';
            }, 420);
            setTimeout(() => {
                form.submit();
            }, 950);
        });
    </script>
@endsection
