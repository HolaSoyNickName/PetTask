<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetTaskController;

// 1. Listado principal (GET)
Route::get('/', [PetTaskController::class, 'index'])->name('tasks.index');

// 2. Formulario para crear (GET)
Route::get('/tasks/create', [PetTaskController::class, 'create'])->name('tasks.create');

// 3. Guardar nueva tarea (POST)
Route::post('/tasks', [PetTaskController::class, 'store'])->name('tasks.store');

// 4. Ver detalle de tarea (GET)
Route::get('/tasks/{id}', [PetTaskController::class, 'show'])->name('tasks.show');

// 5. Formulario para editar (GET)
Route::get('/tasks/{id}/edit', [PetTaskController::class, 'edit'])->name('tasks.edit');

// 6. Actualizar tarea (PUT)
Route::put('/tasks/{id}', [PetTaskController::class, 'update'])->name('tasks.update');

// 7. Eliminar tarea (DELETE)
Route::delete('/tasks/{id}', [PetTaskController::class, 'destroy'])->name('tasks.destroy');