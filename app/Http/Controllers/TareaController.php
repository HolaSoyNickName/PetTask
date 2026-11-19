<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\User;
use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateTareaRequest;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
   public function index()
    {
        $tareas = Auth::check()
            ? Tarea::where('user_id', Auth::id())->latest()->get()
            : Tarea::latest()->get();

        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        $tarea = new Tarea();
        return view('tareas.create', compact('tarea'));
    }

    public function store(StoreTareaRequest $request)
    {
        $datos = $request->validated();

        $usuario = Auth::user() ?? User::first();

        if (! $usuario) {
            $usuario = User::create([
                'name' => 'Usuario PetTask',
                'email' => 'usuario@pettask.com',
                'password' => bcrypt('password123'),
            ]);
        }

        $datos['user_id'] = $usuario->id;
        $datos['estado'] = $datos['estado'] ?? 'Pendiente';

        Tarea::create($datos);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente.');
    }

    public function show(Tarea $tarea)
    {
        return view('tareas.show', compact('tarea'));
    }

public function edit(Tarea $tarea)
    {
        $tareas = Auth::check()
            ? Tarea::where('user_id', Auth::id())->orderBy('id', 'asc')->get()
            : Tarea::orderBy('id', 'asc')->get();

        return view('tareas.edit', compact('tarea', 'tareas'));
    }

    public function update(UpdateTareaRequest $request, Tarea $tarea)
    {
        // Si el usuario eligió otra tarea en el selector de ID, actualizar esa tarea
        if ($request->filled('id') && (int) $request->id !== $tarea->id) {
            $tarea = Tarea::findOrFail($request->id);
        }

        $datos = [
            'titulo' => $request->validated()['titulo'],
            'descripcion' => $request->validated()['descripcion'] ?? null,
        ];

        if ($request->filled('materia')) {
            $datos['materia'] = $request->validated()['materia'];
        }

        $tarea->update($datos);

        return redirect()->route('tareas.index')->with('success', '¡Los cambios de la tarea se guardaron correctamente!');
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada correctamente.');
    }

    public function cambiarEstado(Tarea $tarea)
    {
        $esCompletada = strtolower($tarea->estado ?? '') === 'completada';
        $tarea->update([
            'estado' => $esCompletada ? 'Pendiente' : 'Completada',
        ]);

        return redirect()->back()->with('success', 'Estado de la tarea actualizado.');
    }
}

