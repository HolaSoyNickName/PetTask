<?php

namespace Tests\Feature;

use Tests\TestCase;

class PetTaskValidationTest extends TestCase
{
    /**
     * Comprobar que no se permitan campos obligatorios vacíos al crear.
     */
    public function test_no_se_permiten_campos_obligatorios_vacios_al_crear(): void
    {
        $response = $this->post(route('tasks.store'), [
            'title' => '',
            'subject' => '',
            'status' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title', 'subject', 'status']);
    }

    /**
     * Comprobar que los mensajes de error al crear se muestren en español.
     */
    public function test_los_errores_se_muestran_en_espanol_al_crear(): void
    {
        $response = $this->post(route('tasks.store'), [
            'title' => '',
            'subject' => '',
            'status' => '',
        ]);

        $response->assertSessionHasErrors([
            'title' => 'El título de la tarea es obligatorio.',
            'subject' => 'La materia es obligatoria.',
            'status' => 'El estado de la tarea es obligatorio.',
        ]);
    }

    /**
     * Comprobar que no se acepten datos con formatos o longitudes incorrectas.
     */
    public function test_no_se_acepten_datos_con_formatos_o_longitudes_incorrectas(): void
    {
        $response = $this->post(route('tasks.store'), [
            'title' => 'ab', // menos de 3 caracteres
            'subject' => 'x', // menos de 2 caracteres
            'status' => 'EnProgreso', // no está en in:Pendiente,Completada
            'description' => str_repeat('d', 1001), // excede 1000 caracteres
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'title' => 'El título de la tarea debe tener al menos 3 caracteres.',
            'subject' => 'La materia debe tener al menos 2 caracteres.',
            'status' => 'El estado de la tarea debe ser Pendiente o Completada.',
            'description' => 'La descripción no puede exceder los 1000 caracteres.',
        ]);
    }

    /**
     * Comprobar que los datos válidos se guarden correctamente.
     */
    public function test_los_datos_validos_se_guarden_correctamente(): void
    {
        $data = [
            'title' => 'Proyecto final de Base de Datos',
            'subject' => 'Bases de Datos Avanzadas',
            'status' => 'Pendiente',
            'description' => 'Modelado relacional y procedimientos almacenados.',
        ];

        $response = $this->post(route('tasks.store'), $data);

        $response->assertRedirect(route('tasks.index'));
        $response->assertSessionHas('success', '¡Tarea registrada correctamente!');

        $tasks = session('tasks', []);
        $this->assertCount(1, $tasks);
        $this->assertEquals('Proyecto final de Base de Datos', $tasks[0]['title']);
        $this->assertEquals('Bases de Datos Avanzadas', $tasks[0]['subject']);
        $this->assertEquals('Pendiente', $tasks[0]['status']);
        $this->assertEquals('Modelado relacional y procedimientos almacenados.', $tasks[0]['description']);
    }

    /**
     * Comprobar compatibilidad con nombres de campos en español.
     */
    public function test_guardar_tarea_con_campos_en_espanol(): void
    {
        $data = [
            'titulo' => 'Examen de Matemáticas',
            'materia' => 'Cálculo Diferencial',
            'estado' => 'Completada',
            'descripcion' => 'Estudiar derivadas e integrales.',
        ];

        $response = $this->post(route('tasks.store'), $data);

        $response->assertRedirect(route('tasks.index'));

        $tasks = session('tasks', []);
        $this->assertNotEmpty($tasks);
        $last = end($tasks);
        $this->assertEquals('Examen de Matemáticas', $last['title']);
        $this->assertEquals('Cálculo Diferencial', $last['subject']);
        $this->assertEquals('Completada', $last['status']);
    }

    /**
     * Comprobar que no se permitan campos obligatorios vacíos al actualizar.
     */
    public function test_no_se_permiten_campos_vacios_al_actualizar(): void
    {
        // Registrar tarea primero
        $this->post(route('tasks.store'), [
            'title' => 'Tarea Inicial',
            'subject' => 'Programación',
            'status' => 'Pendiente',
        ]);

        $response = $this->put(route('tasks.update', 1), [
            'title' => '',
            'subject' => '',
            'status' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'title' => 'El título de la tarea es obligatorio.',
            'subject' => 'La materia es obligatoria.',
            'status' => 'El estado de la tarea es obligatorio.',
        ]);
    }

    /**
     * Comprobar que los datos válidos se actualicen correctamente con PUT.
     */
    public function test_los_datos_validos_se_actualizan_correctamente(): void
    {
        // Registrar tarea inicial
        $this->post(route('tasks.store'), [
            'title' => 'Tarea Para Editar',
            'subject' => 'Redes',
            'status' => 'Pendiente',
            'description' => 'Descripción inicial',
        ]);

        $response = $this->put(route('tasks.update', 1), [
            'title' => 'Tarea Modificada',
            'subject' => 'Sistemas Distribuidos',
            'status' => 'Completada',
            'description' => 'Descripción actualizada',
        ]);

        $response->assertRedirect(route('tasks.index'));
        $response->assertSessionHas('success', '¡Tarea actualizada correctamente!');

        $tasks = session('tasks', []);
        $task = collect($tasks)->firstWhere('id', 1);

        $this->assertNotNull($task);
        $this->assertEquals('Tarea Modificada', $task['title']);
        $this->assertEquals('Sistemas Distribuidos', $task['subject']);
        $this->assertEquals('Completada', $task['status']);
        $this->assertEquals('Descripción actualizada', $task['description']);
    }

    /**
     * Comprobar eliminación con DELETE.
     */
    public function test_eliminar_tarea_funciona_con_metodo_delete(): void
    {
        // Registrar tarea
        $this->post(route('tasks.store'), [
            'title' => 'Tarea a Eliminar',
            'subject' => 'Física',
            'status' => 'Pendiente',
        ]);

        $response = $this->delete(route('tasks.destroy', 1));

        $response->assertRedirect(route('tasks.index'));
        $response->assertSessionHas('success', '¡Tarea eliminada correctamente!');

        $tasks = session('tasks', []);
        $task = collect($tasks)->firstWhere('id', 1);
        $this->assertNull($task);
    }

    /**
     * Proteger los formularios: verificar presencia de directivas @csrf y @method en las vistas.
     */
    public function test_formularios_cuentan_con_csrf_y_metodos_http(): void
    {
        // 1. Formulario de creación cuenta con token CSRF
        $createView = $this->get(route('tasks.create'));
        $createView->assertStatus(200);
        $createView->assertSee('name="_token"', false);

        // 2. Formulario de edición cuenta con token CSRF y @method('PUT')
        $this->post(route('tasks.store'), [
            'title' => 'Tarea en Vista',
            'subject' => 'Materia de Vista',
            'status' => 'Pendiente',
        ]);

        $editView = $this->get(route('tasks.edit', 1));
        $editView->assertStatus(200);
        $editView->assertSee('name="_token"', false);
        $editView->assertSee('name="_method" value="PUT"', false);

        // 3. Formulario de eliminación en el listado cuenta con token CSRF y @method('DELETE')
        $indexView = $this->get(route('tasks.index'));
        $indexView->assertStatus(200);
        $indexView->assertSee('name="_token"', false);
        $indexView->assertSee('name="_method" value="DELETE"', false);
    }
}

