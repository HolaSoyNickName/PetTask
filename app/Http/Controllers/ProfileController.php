<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        /** @var User $user */
        $user = Auth::user();
        $tareas = Tarea::where('user_id', $user->id)->get();
        $completadas = $tareas->filter(fn($t) => strtolower($t->estado ?? '') === 'completada')->count();

        $estadisticas = [
            'totales' => $tareas->count(),
            'completadas' => $completadas,
            'pendientes' => $tareas->count() - $completadas,
            'nivel' => max(1, intdiv($completadas, 2) + 1),
        ];

        return view('perfil.edit', compact('user', 'estadisticas'));
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50', Rule::unique('users', 'name')->ignore($user->id)],
            'bio' => ['nullable', 'string', 'max:160'],
            'mascota_nombre' => ['required', 'string', 'min:2', 'max:50'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'name.unique' => 'Ese nombre de usuario ya está en uso.',
            'avatar.image' => 'El archivo debe ser una imagen válida (JPG, PNG o WEBP).',
            'avatar.max' => 'La imagen no debe pesar más de 2 MB.',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        } else {
            unset($validated['avatar']);
        }

        $user->update($validated);

        return redirect()->route('perfil.edit')
            ->with('success', '¡Tu perfil se actualizó correctamente!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'current_password.current_password' => 'La contraseña actual no es correcta.',
            'password.min' => 'La nueva contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas nuevas no coinciden.',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('perfil.edit')
            ->with('success_password', '¡Contraseña actualizada con seguridad!');
    }
}
