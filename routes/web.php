<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetTaskController;

Route::get('/', [PetTaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create', [PetTaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [PetTaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{id}', [PetTaskController::class, 'show'])->name('tasks.show');
Route::get('/tasks/{id}/edit', [PetTaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{id}', [PetTaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{id}', [PetTaskController::class, 'destroy'])->name('tasks.destroy');