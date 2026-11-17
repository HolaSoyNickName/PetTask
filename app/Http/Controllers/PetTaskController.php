<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PetTaskController extends Controller
{
    public function index() { return "Lista de tareas"; }
    public function create() { return "Crear tarea"; }
    public function store(Request $request) { return "Guardar"; }
    public function edit($id) { return "Editar"; }
    public function update(Request $request, $id) { return "Actualizar"; }
    public function destroy($id) { return "Eliminar"; }
}