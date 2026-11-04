<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetTaskController extends Controller
{
    private function getTasks()
    {
        return session()->get('pet_tasks', [
            1 => ['id' => 1, 'title' => 'Entregar ensayo de Historia', 'subject' => 'Historia', 'status' => 'Pendiente', 'description' => 'Redactar 3 páginas sobre la Revolución Mexicana.'],
            2 => ['id' => 2, 'title' => 'Estudiar para examen de Matemáticas', 'subject' => 'Matemáticas', 'status' => 'Completada', 'description' => 'Repasar ejercicios de derivadas e integrales.']
        ]);
    }

    public function index()
    {
        $tasks = $this->getTasks();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $tasks = $this->getTasks();
        $id = count($tasks) > 0 ? max(array_keys($tasks)) + 1 : 1;

        $tasks[$id] = [
            'id' => $id,
            'title' => $request->title,
            'subject' => $request->subject,
            'status' => 'Pendiente',
            'description' => $request->description,
        ];

        session()->put('pet_tasks', $tasks);

        return redirect()->route('tasks.index')->with('success', '¡Tarea escolar creada!');
    }

    public function show($id)
    {
        $tasks = $this->getTasks();
        abort_if(!isset($tasks[$id]), 404);
        $task = $tasks[$id];

        return view('tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $tasks = $this->getTasks();
        abort_if(!isset($tasks[$id]), 404);
        $task = $tasks[$id];

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $tasks = $this->getTasks();
        abort_if(!isset($tasks[$id]), 404);

        $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'status' => 'required|in:Pendiente,Completada',
            'description' => 'nullable|string',
        ]);

        $tasks[$id] = [
            'id' => (int)$id,
            'title' => $request->title,
            'subject' => $request->subject,
            'status' => $request->status,
            'description' => $request->description,
        ];

        session()->put('pet_tasks', $tasks);

        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $tasks = $this->getTasks();
        if (isset($tasks[$id])) {
            unset($tasks[$id]);
            session()->put('pet_tasks', $tasks);
        }

        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada exitosamente.');
    }
}