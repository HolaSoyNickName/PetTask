<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateTareaRequest;

class TareaController extends Controller
{
    // Muestra carga-de-datos-general.html
    public function index()
    {
        $tareas = []; // Cuando conecten la BD: Tarea::latest()->get();
        return view('tareas.index', compact('tareas'));
    }

    // Muestra agregar-tareas.html
    public function create()
    {
        $tarea = new Tarea();
        return view('tareas.create', compact('tarea'));
    }

    // Valida con FormRequest y guarda
    public function store(StoreTareaRequest $request)
    {
        Tarea::create($request->validated());
        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente.');
    }

    // Route Model Binding (Tarea $tarea)
    public function show(Tarea $tarea)
    {
        return view('tareas.show', compact('tarea'));
    }

    // Muestra actualizar-tarea.html con Route Model Binding
    public function edit(Tarea $tarea)
    {
        return view('tareas.edit', compact('tarea'));
    }

    // Valida con FormRequest y actualiza usando Route Model Binding
    public function update(UpdateTareaRequest $request, Tarea $tarea)
    {
        $tarea->update($request->validated());
        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada.');
    }

    // Elimina usando Route Model Binding
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada.');
    }
}
