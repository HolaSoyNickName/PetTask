<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Editar Racha</title></head>
<body>
    <h1>Editar Racha</h1>
    <form action="{{ route('streaks.update', $streak) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Título:</label><br><input type="text" name="titulo" value="{{ old('titulo', $streak->titulo) }}"><br><br>
        <label>Descripción:</label><br><textarea name="descripcion">{{ old('descripcion', $streak->descripcion) }}</textarea><br><br>
        <label>Usuario:</label><br>
        <select name="user_id">
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id', $streak->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select><br><br>
        <label><input type="checkbox" name="completada" value="1" {{ old('completada', $streak->completada) ? 'checked' : '' }}> ¿Completada?</label><br><br>
        <button type="submit">Actualizar</button> <a href="{{ route('streaks.index') }}">Cancelar</a>
    </form>
</body>
</html>