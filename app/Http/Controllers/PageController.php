<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function inicio() { return view('pages.inicio'); }
    public function nosotros() { return view('pages.nosotros'); }
    public function servicios() { return view('pages.servicios'); }
    public function contacto() { return view('pages.contacto'); }
    public function login() { return view('auth.login'); }
    public function registro() { return view('auth.registro'); }

    public function resumen()
    {
        $tareas = Tarea::all();
        $pendientes = $tareas->filter(fn($t) => strtolower($t->estado ?? 'pendiente') !== 'completada')->count();
        $completadas = $tareas->filter(fn($t) => strtolower($t->estado ?? '') === 'completada')->count();

        $resumen = [
            'total_tareas' => $tareas->count(),
            'tareas_pendientes' => $pendientes,
            'tareas_completadas' => $completadas,
            'nombre_mascota' => 'Firulais',
            'estado_mascota' => 'Feliz',
            'nivel_mascota' => 5,
            'racha_actual' => $completadas,
            'mejor_racha' => max($completadas, 7),
        ];

        return view('tareas.resumen', compact('resumen'));
    }

    public function actualizarTarea(Request $request)
    {
        $tareas = Tarea::orderBy('id', 'asc')->get();
        $tarea = $request->filled('tarea_id')
            ? Tarea::find($request->tarea_id)
            : $tareas->first();

        return view('tareas.edit', compact('tareas', 'tarea'));
    }

    public function eliminarTareas(Request $request)
    {
        $tareas = Tarea::when($request->filled('materia'), function ($query) use ($request) {
            $query->where('materia', 'ilike', '%' . $request->materia . '%');
        })->latest()->get();

        return view('tareas.eliminar', compact('tareas'));
    }

    public function recordatorios()
    {
        $recordatorios = Tarea::latest()->get();
        return view('tareas.recordatorios', compact('recordatorios'));
    }

    public function interaccion()
    {
        $tareas = Tarea::all();
        $completadas = $tareas->filter(fn($t) => strtolower($t->estado ?? '') === 'completada')->count();
        $racha = $completadas;
        $nivel = max(1, intdiv($completadas, 2) + 1);

        $logros = [];
        if ($tareas->count() >= 1) $logros[] = 'Primera tarea registrada';
        if ($completadas >= 1) $logros[] = 'Primera tarea completada';
        if ($racha >= 3) $logros[] = 'Racha de 3 tareas';
        if ($racha >= 7) $logros[] = 'Racha de 7 tareas';
        if ($completadas >= 10) $logros[] = '10 tareas completadas';
        if ($nivel >= 5) $logros[] = 'Mascota nivel 5';

        $datosMascota = [
            'nombre' => 'Firulais',
            'estado' => $completadas > 0 ? 'Feliz' : 'Esperando tareas',
            'nivel' => $nivel,
            'energia' => min(100, 60 + ($completadas * 10)),
            'felicidad' => min(100, 70 + ($completadas * 10)),
            'hambre' => max(10, 50 - ($completadas * 10)),
            'completadas' => $completadas,
            'racha' => $racha,
            'logros' => $logros,
        ];

        return view('mascota.interaccion', compact('datosMascota'));
    }

    public function tienda() { return view('mascota.tienda'); }

    public function racha()
    {
        $completadas = Tarea::all()->filter(fn($t) => strtolower($t->estado ?? '') === 'completada')->count();
        $rachaActual = $completadas;
        $mejorRacha = max($completadas, 7);
        return view('mascota.racha', compact('rachaActual', 'mejorRacha'));
    }
}