@extends('layouts.app')

@section('title', 'Registrarse - PetTask')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/estilos-sitio.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/auth-futurista.css') }}" />
@endsection

@section('content')
    <main class="auth-stage">
        <div class="auth-card-wrapper {{ $errors->any() ? 'has-error' : '' }}" id="authCardWrapper">
            <section class="auth-card">
                <h1 class="auth-titulo">Registrarse</h1>

                <form id="formRegistro" action="{{ route('registro.post') }}" method="POST">
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
                                placeholder="Crea una contraseña" required minlength="6" />
                            <button type="button" class="auth-toggle-pass" onclick="togglePassword('password', this)"
                                aria-label="Mostrar u ocultar contraseña">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                        <!-- Medidor futurista de seguridad -->
                        <div class="pass-strength">
                            <div class="pass-strength__track">
                                <div class="pass-strength__fill" id="strengthFill"></div>
                            </div>
                            <div class="pass-strength__label">
                                <span>Seguridad</span>
                                <span id="strengthText">Mínimo 6 caracteres</span>
                            </div>
                        </div>

                        @error('password')
                            <span class="auth-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-campo">
                        <label for="password_confirmation">Confirmar contraseña</label>
                        <div class="auth-input-wrap">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="auth-input auth-input--password" placeholder="Confirma tu contraseña" required
                                minlength="6" />
                            <button type="button" class="auth-toggle-pass"
                                onclick="togglePassword('password_confirmation', this)"
                                aria-label="Mostrar u ocultar confirmación de contraseña">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="pass-match" id="passMatch"></div>
                    </div>

                    <button type="submit" class="auth-btn">Crear cuenta</button>
                </form>

                <p class="auth-pie">
                    ¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar sesión</a>
                </p>

                <div class="auth-hud" id="authHud" aria-live="polite">
                    <div class="hud-orbita">
                        <div class="hud-anillo"></div>
                        <div class="hud-anillo-interno"></div>
                        <i class="bi bi-person-check hud-icono"></i>
                    </div>
                    <div class="hud-texto" id="hudTexto">Creando identidad digital...</div>
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

        const passInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        const strengthFill = document.getElementById('strengthFill');
        const strengthText = document.getElementById('strengthText');
        const passMatch = document.getElementById('passMatch');

        function evaluarSeguridad() {
            const val = passInput.value;
            let puntos = 0;
            if (val.length >= 6) puntos++;
            if (val.length >= 10) puntos++;
            if (/[A-Z]/.test(val) && /[a-z]/.test(val)) puntos++;
            if (/\d/.test(val) || /[^A-Za-z0-9]/.test(val)) puntos++;

            const niveles = [{
                    ancho: '0%',
                    color: 'transparent',
                    texto: 'Mínimo 6 caracteres'
                },
                {
                    ancho: '28%',
                    color: '#ff6b81',
                    texto: 'Débil'
                },
                {
                    ancho: '55%',
                    color: '#f59e0b',
                    texto: 'Media'
                },
                {
                    ancho: '80%',
                    color: '#8294f2',
                    texto: 'Buena'
                },
                {
                    ancho: '100%',
                    color: '#22c55e',
                    texto: 'Segura'
                },
            ];

            const nivel = val.length === 0 ? niveles[0] : niveles[Math.max(1, puntos)];
            strengthFill.style.width = nivel.ancho;
            strengthFill.style.backgroundColor = nivel.color;
            strengthFill.style.boxShadow = val.length > 0 ? `0 0 10px ${nivel.color}88` : 'none';
            strengthText.textContent = nivel.texto;
            strengthText.style.color = val.length > 0 ? nivel.color : '#5c6484';

            verificarCoincidencia();
        }

        function verificarCoincidencia() {
            if (!confirmInput.value) {
                passMatch.innerHTML = '';
                passMatch.className = 'pass-match';
                return true;
            }
            if (passInput.value === confirmInput.value) {
                passMatch.innerHTML = '<i class="bi bi-check-circle-fill"></i> Las contraseñas coinciden';
                passMatch.className = 'pass-match pass-match--ok';
                return true;
            } else {
                passMatch.innerHTML = '<i class="bi bi-x-circle-fill"></i> Las contraseñas no coinciden';
                passMatch.className = 'pass-match pass-match--error';
                return false;
            }
        }

        passInput.addEventListener('input', evaluarSeguridad);
        confirmInput.addEventListener('input', verificarCoincidencia);

        document.getElementById('formRegistro').addEventListener('submit', function(e) {
            e.preventDefault();

            if (!verificarCoincidencia()) {
                const wrapper = document.getElementById('authCardWrapper');
                wrapper.classList.remove('has-error');
                void wrapper.offsetWidth;
                wrapper.classList.add('has-error');
                confirmInput.focus();
                return;
            }

            const form = this;
            const hud = document.getElementById('authHud');
            const texto = document.getElementById('hudTexto');

            hud.classList.add('activo');
            setTimeout(() => {
                texto.textContent = 'Enlazando cuenta con la base de datos...';
            }, 420);
            setTimeout(() => {
                form.submit();
            }, 950);
        });
    </script>
@endsection
