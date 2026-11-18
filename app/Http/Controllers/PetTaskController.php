<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetTaskRequest;
use App\Http\Requests\UpdatePetTaskRequest;
use App\Models\Tarea;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class PetTaskController extends Controller
{
    public function index(): View
    {
        $tasks = session('tasks', []);

        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        return view('tasks.create');
    }

    public function store(StorePetTaskRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $tasks = session('tasks', []);

        $id = count($tasks) > 0
            ? max(array_column($tasks, 'id')) + 1
            : 1;

        $taskData = [
            'id' => $id,
            'title' => $validated['title'],
            'subject' => $validated['subject'],
            'status' => $validated['status'] ?? 'Pendiente',
            'description' => $validated['description'] ?? null,
        ];

        $tasks[] = $taskData;

        session(['tasks' => $tasks]);

        if (Auth::check() && class_exists(Tarea::class) && Schema::hasTable('tareas')) {
            Tarea::create([
                'titulo' => $validated['title'],
                'materia' => $validated['subject'],
                'descripcion' => $validated['description'] ?? null,
                'estado' => $validated['status'] ?? 'Pendiente',
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->route('tasks.index')
            ->with('success', '¡Tarea registrada correctamente!');
    }

    public function show(int|string $id): View
    {
        $tasks = session('tasks', []);
        $task = collect($tasks)->firstWhere('id', (int) $id);

        if (! $task) {
            abort(404, 'Tarea no encontrada.');
        }

        return view('tasks.show', compact('task'));
    }

    public function edit(int|string $id): View
    {
        $tasks = session('tasks', []);
        $task = collect($tasks)->firstWhere('id', (int) $id);

        if (! $task) {
            abort(404, 'Tarea no encontrada.');
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(UpdatePetTaskRequest $request, int|string $id): RedirectResponse
    {
        $validated = $request->validated();

        $tasks = session('tasks', []);
        $found = false;

        foreach ($tasks as &$task) {
            if ($task['id'] == (int) $id) {
                $task['title'] = $validated['title'];
                $task['subject'] = $validated['subject'];
                $task['status'] = $validated['status'];
                $task['description'] = $validated['description'] ?? null;
                $found = true;
                break;
            }
        }
        unset($task);

        if (! $found) {
            abort(404, 'Tarea no encontrada.');
        }

        session(['tasks' => $tasks]);

        return redirect()->route('tasks.index')
            ->with('success', '¡Tarea actualizada correctamente!');
    }

    public function destroy(int|string $id): RedirectResponse
    {
        $tasks = session('tasks', []);

        $tasks = array_values(array_filter($tasks, function ($task) use ($id) {
            return $task['id'] != (int) $id;
        }));

        session(['tasks' => $tasks]);

        return redirect()->route('tasks.index')
            ->with('success', '¡Tarea eliminada correctamente!');
    }
}