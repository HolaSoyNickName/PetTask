<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePetTaskRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Preparar los datos para la validación.
     * Permite compatibilidad con nombres en español e inglés.
     */
    protected function prepareForValidation(): void
    {
        $merge = [];

        if ($this->has('titulo') && ! $this->has('title')) {
            $merge['title'] = $this->titulo;
        }

        if ($this->has('materia') && ! $this->has('subject')) {
            $merge['subject'] = $this->materia;
        }

        if ($this->has('estado') && ! $this->has('status')) {
            $merge['status'] = $this->estado;
        }

        if ($this->has('descripcion') && ! $this->has('description')) {
            $merge['description'] = $this->descripcion;
        }

        if (! empty($merge)) {
            $this->merge($merge);
        }
    }

    /**
     * Reglas de validación para actualizar una tarea.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'subject' => ['required', 'string', 'min:2', 'max:255'],
            'status' => ['required', 'string', Rule::in(['Pendiente', 'Completada'])],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Mensajes de error personalizados en español.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'El título de la tarea es obligatorio.',
            'title.string' => 'El título de la tarea debe ser un texto válido.',
            'title.min' => 'El título de la tarea debe tener al menos 3 caracteres.',
            'title.max' => 'El título de la tarea no puede exceder los 255 caracteres.',

            'subject.required' => 'La materia es obligatoria.',
            'subject.string' => 'La materia debe ser un texto válido.',
            'subject.min' => 'La materia debe tener al menos 2 caracteres.',
            'subject.max' => 'La materia no puede exceder los 255 caracteres.',

            'status.required' => 'El estado de la tarea es obligatorio.',
            'status.string' => 'El estado de la tarea debe ser un texto válido.',
            'status.in' => 'El estado de la tarea debe ser Pendiente o Completada.',

            'description.string' => 'La descripción debe ser un texto válido.',
            'description.max' => 'La descripción no puede exceder los 1000 caracteres.',
        ];
    }

    /**
     * Nombres legibles en español para los atributos.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'título',
            'subject' => 'materia',
            'status' => 'estado',
            'description' => 'descripción',
        ];
    }
}
