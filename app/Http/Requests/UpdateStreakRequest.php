<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStreakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'completada' => 'boolean',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
