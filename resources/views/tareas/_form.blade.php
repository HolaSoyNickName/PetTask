@csrf

@if (($modo ?? 'crear') === 'actualizar')
    <div class="campo">
        <label for="id" class="form-label"> ID de la tarea </label>
        <input type="text" class="form-control" id="id" name="id" value="{{ old('id', $tarea->id ?? '') }}"
            placeholder="Ingresa el ID de la tarea" />
    </div>
    <div class="campo">
        <label for="nombre" class="form-label"> Nombre de la tarea </label>
        <input type="text" class="form-control" id="nombre" name="tarea"
            value="{{ old('tarea', $tarea->tarea ?? '') }}" placeholder="Ingresa el nombre de la tarea" />
        @error('tarea')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
@else
    <div class="campo">
        <label for="materia" class="form-label"> Materia </label>
        <input type="text" id="materia" name="materia" class="form-control"
            value="{{ old('materia', $tarea->materia ?? '') }}" placeholder="Ingresa la materia" required />
        @error('materia')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="campo">
        <label for="tarea" class="form-label"> Tarea </label>
        <input type="text" id="tarea" name="tarea" class="form-control"
            value="{{ old('tarea', $tarea->tarea ?? '') }}" placeholder="Ingresa el nombre de la tarea" required />
        @error('tarea')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
@endif

<div class="campo">
    <label for="descripcion" class="form-label">
        {{ ($modo ?? 'crear') === 'actualizar' ? 'Descripción' : 'Descripción de tarea' }}
    </label>
    <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Escribe una descripción de la tarea">{{ old('descripcion', $tarea->descripcion ?? '') }}</textarea>
    @error('descripcion')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="botones">
    <a href="{{ route('inicio') }}" class="btn-cancelar text-decoration-none text-center"> Cancelar </a>
    @if (($modo ?? 'crear') === 'actualizar')
        <button type="submit" class="btn-guardar" data-bs-toggle="modal" data-bs-target="#modalConfirmar">
            Guardar cambios
        </button>
    @else
        <button type="submit" class="btn-guardar"> Guardar tarea </button>
    @endif
</div>
