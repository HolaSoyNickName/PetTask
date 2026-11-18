<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\PetTaskController;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'inicio'])->name('inicio');
Route::get('/nosotros', [PageController::class, 'nosotros'])->name('nosotros');
Route::get('/servicios', [PageController::class, 'servicios'])->name('servicios');
Route::get('/contacto', [PageController::class, 'contacto'])->name('contacto');
Route::get('/iniciar-sesion', [PageController::class, 'login'])->name('login');
Route::get('/registro', [PageController::class, 'registro'])->name('registro');

// Rutas RESTful con Route Model Binding (Rúbrica) y controlador de sesión del equipo
Route::resource('tareas', TareaController::class);
Route::resource('tasks', PetTaskController::class);
Route::resource('tareas', TareaController::class);

Route::patch('/tareas/{tarea}/estado', [TareaController::class, 'cambiarEstado'])->name('tareas.estado');
Route::get('/resumen-general', [PageController::class, 'resumen'])->name('resumen');
Route::get('/actualizar-tarea', [PageController::class, 'actualizarTarea'])->name('tareas.actualizar.vista');
Route::get('/eliminar-tareas', [PageController::class, 'eliminarTareas'])->name('tareas.eliminar.vista');
Route::get('/recordatorios', [PageController::class, 'recordatorios'])->name('recordatorios');

Route::get('/interaccion-con-mascota', [PageController::class, 'interaccion'])->name('mascota.interaccion');
Route::get('/tienda-de-mascota', [PageController::class, 'tienda'])->name('mascota.tienda');
Route::get('/racha-de-actividad', [PageController::class, 'racha'])->name('mascota.racha');