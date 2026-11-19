<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegistro()
    {
        return view('auth.registro');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'usuario' => ['required', 'string', 'min:3', 'max:50', 'unique:users,name'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'usuario.required' => 'Ingresa un nombre de usuario.',
            'usuario.unique' => 'Ese usuario ya existe, intenta con otro.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = User::create([
            'name' => $validated['usuario'],
            'email' => Str::slug($validated['usuario']) . '.' . uniqid() . '@pettask.local',
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('inicio')
            ->with('auth_welcome', '¡Cuenta creada con éxito! Bienvenido, ' . $user->name);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'usuario' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'usuario.required' => 'Ingresa tu usuario.',
            'password.required' => 'Ingresa tu contraseña.',
        ]);

        if (Auth::attempt(['name' => $credentials['usuario'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            return redirect()->route('inicio')
                ->with('auth_welcome', '¡Sesión iniciada! Qué gusto verte, ' . Auth::user()->name);
        }

        return back()
            ->withErrors(['usuario' => 'Usuario o contraseña incorrectos.'])
            ->onlyInput('usuario');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('inicio');
    }
}
