<?php

namespace App\Http\Controllers;



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
    $resumen = [
        'total_tareas' => 0,
        'tareas_pendientes' => 0,
        'tareas_completadas' => 0,
        'nombre_mascota' => 'Sin datos',
        'estado_mascota' => 'Sin datos',
        'nivel_mascota' => 0,
        'racha_actual' => 0,
        'mejor_racha' => 0,
    ];
    return view('tareas.resumen', compact('resumen'));}
    public function actualizarTarea() { return view('tareas.edit'); }
    public function eliminarTareas() { return view('tareas.eliminar'); }
    public function recordatorios() { return view('tareas.recordatorios'); }
    public function interaccion() { return view('mascota.interaccion'); }
    public function tienda() { return view('mascota.tienda'); }
    public function racha() { return view('mascota.racha'); }
}
