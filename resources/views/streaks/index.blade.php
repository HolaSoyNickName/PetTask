<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Rachas</title>
</head>
<body>
    <h1>Lista de Rachas</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <form action="{{ route('streaks.index') }}" method="GET">
        <input type="text" name="buscar" value="{{ $buscar }}" placeholder="Buscar...">
        <button type="submit">Buscar</button>
        <a href="{{ route('streaks.create') }}">+ Crear Nueva Racha</a>
    </form>
    <br>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th><th>Título</th><th>Usuario</th><th>Completada</th><th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($streaks as $streak)
            <tr>
                <td>{{ $streak->id }}</td>
                <td>{{ $streak->titulo }}</td>
                <td>{{ $streak->user->name ?? 'Sin asignar' }}</td>
                <td>{{ $streak->completada ? 'Sí' : 'No' }}</td>
                <td>
                    <a href="{{ route('streaks.edit', $streak) }}">Editar</a>
                    <form action="{{ route('streaks.destroy', $streak) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Seguro?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>{{ $streaks->links() }}</div>
</body>
</html>