<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Crear Racha</title></head>
<body>
    <h1>Crear Nueva Racha</h1>
    <form action="{{ route('streaks.store') }}" method="POST">
        @csrf
        <label>Título:</label><br><input type="text" name="titulo" value="{{ old('titulo') }}"><br><br>
        <label>Descripción:</label><br><textarea name="descripcion">{{ old('descripcion') }}</textarea><br><br>
        <label>Usuario:</label><br>
        <select name="user_id">
            <option value="">Seleccione...</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select><br><br>
        <label><input type="checkbox" name="completada" value="1"> ¿Completada?</label><br><br>
        <button type="submit">Guardar</button> <a href="{{ route('streaks.index') }}">Cancelar</a>
    </form>
</body>
</html>