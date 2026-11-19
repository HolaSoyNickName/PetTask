@extends('layouts.app')

@section('title', 'Configuración de Perfil - PetTask')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/estilos-sitio.css') }}" />
@endsection

@section('content')
    <main class="perfil-container">
        <div class="perfil-grid">
            <!-- Tarjeta izquierda: Avatar + Resumen del estudiante -->
            <aside class="perfil-card text-center">
                <div class="perfil-avatar-box">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Foto de perfil" id="previewAvatarImg"
                            class="perfil-avatar-img" />
                        <div id="previewAvatarPlaceholder" class="perfil-avatar-placeholder d-none">
                            {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                        </div>
                    @else
                        <img src="" alt="Foto de perfil" id="previewAvatarImg" class="perfil-avatar-img d-none" />
                        <div id="previewAvatarPlaceholder" class="perfil-avatar-placeholder">
                            {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                        </div>
                    @endif

                    <label for="inputAvatar" class="perfil-camara-btn" title="Cambiar foto de perfil">
                        <i class="bi bi-camera-fill"></i>
                    </label>
                </div>

                <h2 class="h4 fw-bold mb-1" style="color: #1e1e50;">{{ $user->name }}</h2>
                <p class="small text-muted mb-2">
                    {{ $user->bio ?: 'Agrega tu carrera o meta de estudio para personalizar tu perfil.' }}
                </p>

                <span class="badge rounded-pill px-3 py-2"
                    style="background: #eef2ff; color: #6378f0; border: 1px solid #8ea8f8;">
                    <i class="bi bi-award-fill me-1"></i>
                    Mascota "{{ $user->mascota_nombre ?? 'Firulais' }}" · Nivel {{ $estadisticas['nivel'] }}
                </span>

                <div class="perfil-stats">
                    <div class="perfil-stat-item">
                        <span class="perfil-stat-num">{{ $estadisticas['totales'] }}</span>
                        <span class="perfil-stat-lbl">Totales</span>
                    </div>
                    <div class="perfil-stat-item">
                        <span class="perfil-stat-num" style="color: #ff6b81;">{{ $estadisticas['pendientes'] }}</span>
                        <span class="perfil-stat-lbl">Pendientes</span>
                    </div>
                    <div class="perfil-stat-item">
                        <span class="perfil-stat-num" style="color: #22c55e;">{{ $estadisticas['completadas'] }}</span>
                        <span class="perfil-stat-lbl">Hechas</span>
                    </div>
                </div>
            </aside>

            <!-- Columna derecha: Datos del perfil y Seguridad -->
            <div class="d-flex flex-column gap-4">
                <!-- Formulario de datos y foto -->
                <section class="perfil-card">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-person-vcard fs-4" style="color: #6378f0;"></i>
                        <h1 class="h4 fw-bold m-0" style="color: #1e1e50;">Configuración de cuenta</h1>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success border-0 rounded-4 mb-3">
                            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="file" id="inputAvatar" name="avatar" accept="image/png,image/jpeg,image/webp"
                            class="d-none" />
                        @error('avatar')
                            <div class="text-danger small mb-3">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold" style="color: #1e1e50;">Nombre de
                                usuario</label>
                            <input type="text" id="name" name="name" class="perfil-input"
                                value="{{ old('name', $user->name) }}" required />
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mascota_nombre" class="form-label fw-semibold" style="color: #1e1e50;">
                                Nombre de tu mascota virtual
                            </label>
                            <input type="text" id="mascota_nombre" name="mascota_nombre" class="perfil-input"
                                value="{{ old('mascota_nombre', $user->mascota_nombre ?? 'Firulais') }}"
                                placeholder="Ej. Max, Luna, Firulais..." required />
                            @error('mascota_nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="bio" class="form-label fw-semibold" style="color: #1e1e50;">
                                Carrera o meta de estudio
                            </label>
                            <textarea id="bio" name="bio" rows="2" class="perfil-input"
                                placeholder="Ej. Ingeniería en TI · Meta: terminar todas mis entregas a tiempo">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Haz clic en el icono de cámara para previsualizar tu nueva foto.
                            </small>
                            <button type="submit" class="perfil-btn-guardar">
                                <i class="bi bi-floppy me-1"></i> Guardar cambios
                            </button>
                        </div>
                    </form>
                </section>

                <!-- Mejora 2: Seguridad y cambio de contraseña -->
                <section class="perfil-card">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-shield-lock fs-4" style="color: #ff6b81;"></i>
                        <h2 class="h5 fw-bold m-0" style="color: #1e1e50;">Seguridad de la cuenta</h2>
                    </div>

                    @if (session('success_password'))
                        <div class="alert alert-success border-0 rounded-4 mb-3">
                            <i class="bi bi-shield-check me-1"></i> {{ session('success_password') }}
                        </div>
                    @endif

                    <form action="{{ route('perfil.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-semibold" style="color: #1e1e50;">
                                Contraseña actual
                            </label>
                            <input type="password" id="current_password" name="current_password" class="perfil-input"
                                placeholder="Escribe tu contraseña actual" required />
                            @error('current_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="new_password" class="form-label fw-semibold" style="color: #1e1e50;">
                                    Nueva contraseña
                                </label>
                                <input type="password" id="new_password" name="password" class="perfil-input"
                                    placeholder="Mínimo 6 caracteres" required minlength="6" />
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="new_password_confirmation" class="form-label fw-semibold"
                                    style="color: #1e1e50;">
                                    Confirmar nueva contraseña
                                </label>
                                <input type="password" id="new_password_confirmation" name="password_confirmation"
                                    class="perfil-input" placeholder="Repite la nueva contraseña" required
                                    minlength="6" />
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="perfil-btn-secundario">
                                <i class="bi bi-key me-1"></i> Actualizar contraseña
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('inputAvatar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(ev) {
                const img = document.getElementById('previewAvatarImg');
                const placeholder = document.getElementById('previewAvatarPlaceholder');
                img.src = ev.target.result;
                img.classList.remove('d-none');
                placeholder.classList.add('d-none');
            };
            reader.readAsDataURL(file);
        });
    </script>
@endsection
