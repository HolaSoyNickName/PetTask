<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetTaskController extends Controller
{
    // Mostrar todas las tareas
    public function index()
    {
        $tasks = session('tasks', []);

        return view('tasks.index', compact('tasks'));
    }

    // Mostrar formulario para crear tarea
    public function create()
    {
        return view('tasks.create');
    }

    // Guardar nueva tarea
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'status' => 'required|string'
        ]);

        $tasks = session('tasks', []);

        $id = count($tasks) > 0
            ? max(array_column($tasks, 'id')) + 1
            : 1;

        $tasks[] = [
            'id' => $id,
            'title' => $request->title,
            'subject' => $request->subject,
            'status' => $request->status
        ];

        session(['tasks' => $tasks]);

        return redirect()->route('tasks.index')
            ->with('success', '¡Tarea registrada correctamente!');
    }

    // Mostrar tarea
    public function show($id)
    {
        $tasks = session('tasks', []);
        $task = collect($tasks)->firstWhere('id', $id);

        if (!$task) {
            abort(404);
        }

        return view('tasks.show', compact('task'));
    }

    // Editar tarea
    public function edit($id)
    {
        $tasks = session('tasks', []);
        $task = collect($tasks)->firstWhere('id', $id);

        if (!$task) {
            abort(404);
        }

        return view('tasks.edit', compact('task'));
    }

    // Actualizar tarea
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'status' => 'required|string'
        ]);

        $tasks = session('tasks', []);

        foreach ($tasks as &$task) {
            if ($task['id'] == $id) {
                $task['title'] = $request->title;
                $task['subject'] = $request->subject;
                $task['status'] = $request->status;
                break;
            }
        }

        unset($task);

        session(['tasks' => $tasks]);

        return redirect()->route('tasks.index')
            ->with('success', '¡Tarea actualizada correctamente!');
    }

    // Eliminar tarea
    public function destroy($id)
    {
        $tasks = session('tasks', []);

        $tasks = array_values(array_filter($tasks, function ($task) use ($id) {
            return $task['id'] != $id;
        }));

        session(['tasks' => $tasks]);

        return redirect()->route('tasks.index')
            ->with('success', '¡Tarea eliminada correctamente!');
    }
}
