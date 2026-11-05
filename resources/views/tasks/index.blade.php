
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetTask - Mis Tareas Escolares</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light p-4">
    <div class="container">

        <h1 class="mb-4">🐾 PetTask - Mis Tareas Escolares</h1>

        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Botón para crear una nueva tarea --}}
        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">
            Nueva Tarea
        </a>

        {{-- Tabla de tareas --}}
        <div class="table-responsive">
            <table class="table table-striped table-bordered bg-white">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Materia</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($tasks as $task)

                        <tr>
                            <td>{{ $task['id'] }}</td>
                            <td>{{ $task['title'] }}</td>
                            <td>{{ $task['subject'] }}</td>

                            <td>
                                <span class="badge {{ $task['status'] == 'Completada' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $task['status'] }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('tasks.show', $task['id']) }}"
                                   class="btn btn-sm btn-info text-white">
                                    Ver
                                </a>

                                <a href="{{ route('tasks.edit', $task['id']) }}"
                                   class="btn btn-sm btn-warning">
                                    Editar
                                </a>

                                <form action="{{ route('tasks.destroy', $task['id']) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Eliminar tarea?')">
                                        Borrar
                                    </button>

                                </form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center">
                                No hay tareas registradas.
                            </td>
                        </tr>

                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</body>
</html>
