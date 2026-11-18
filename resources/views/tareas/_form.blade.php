@csrf

@if(($modo ?? 'crear') === 'actualizar')
    <div class="campo">
        <label for="id" class="form-label"> ID de la tarea </label>
        <select class="form-control" id="id" name="id" onchange="cargarTareaSeleccionada(this)">
            @foreach($tareas ?? [] as $item)
                <option value="{{ $item->id }}"
                    data-url="{{ route('tareas.update', $item) }}"
                    data-materia="{{ $item->materia }}"
                    data-titulo="{{ $item->titulo }}"
                    data-descripcion="{{ $item->descripcion }}"
                    {{ (isset($tarea) && $tarea?->id === $item->id) ? 'selected' : '' }}>
                    #{{ $item->id }} - {{ $item->materia }}: {{ $item->titulo }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="campo">
        <label for="materia" class="form-label"> Materia </label>
        <input type="text" class="form-control" id="materia" name="materia"
            value="{{ old('materia', $tarea->materia ?? '') }}"
            placeholder="Ingresa la materia" required />
    </div>
    <div class="campo">
        <label for="nombre" class="form-label"> Nombre de la tarea </label>
        <input type="text" class="form-control" id="nombre" name="titulo"
            value="{{ old('titulo', $tarea->titulo ?? '') }}"
            placeholder="Ingresa el nombre de la tarea" required />
    </div>

    <script>
        function cargarTareaSeleccionada(select) {
            const option = select.options[select.selectedIndex];
            if (!option) return;
            const form = document.getElementById('formActualizarTarea');
            if (form && option.dataset.url) {
                form.action = option.dataset.url;
            }
            document.getElementById('materia').value = option.dataset.materia || '';
            document.getElementById('nombre').value = option.dataset.titulo || '';
            document.getElementById('descripcion').value = option.dataset.descripcion || '';
        }
    </script>
@else
    <div class="campo">
        <label for="materia" class="form-label"> Materia </label>
        <input type="text" id="materia" name="materia" class="form-control"
            value="{{ old('materia', $tarea->materia ?? '') }}"
            placeholder="Ingresa la materia" required />
    </div>
    <div class="campo">
        <label for="tarea" class="form-label"> Tarea </label>
        <input type="text" id="tarea" name="titulo" class="form-control"
            value="{{ old('titulo', $tarea->titulo ?? '') }}"
            placeholder="Ingresa el nombre de la tarea" required />
    </div>
@endif

<div class="campo">
    <label for="descripcion" class="form-label">
        {{ ($modo ?? 'crear') === 'actualizar' ? 'Descripción' : 'Descripción de tarea' }}
    </label>
    <textarea class="form-control" id="descripcion" name="descripcion"
        placeholder="Escribe una descripción de la tarea">{{ old('descripcion', $tarea->descripcion ?? '') }}</textarea>
</div>

<div class="botones">
    <a href="{{ route('tareas.index') }}" class="btn-cancelar text-decoration-none text-center"> Cancelar </a>
    <button type="submit" class="btn-guardar">
        {{ ($modo ?? 'crear') === 'actualizar' ? 'Guardar cambios' : 'Guardar tarea' }}
    </button>
</div>