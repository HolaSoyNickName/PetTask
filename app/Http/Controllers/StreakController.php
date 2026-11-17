<?php

namespace App\Http\Controllers;

use App\Models\Streak;
use App\Models\User;
use App\Http\Requests\StoreStreakRequest;
use App\Http\Requests\UpdateStreakRequest;
use Illuminate\Http\Request;

class StreakController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $streaks = Streak::with('user')->when($buscar, function ($query, $buscar) {
            return $query->where('titulo', 'like', "%{$buscar}%");
        })->paginate(5);

        return view('streaks.index', compact('streaks', 'buscar'));
    }

    public function create()
    {
        $users = User::all();
        return view('streaks.create', compact('users'));
    }

    public function store(StoreStreakRequest $request)
    {
        Streak::create($request->validated());
        return redirect()->route('streaks.index')->with('success', 'Racha creada.');
    }

    public function edit(Streak $streak)
    {
        $users = User::all();
        return view('streaks.edit', compact('streak', 'users'));
    }

    public function update(UpdateStreakRequest $request, Streak $streak)
    {
        $streak->update($request->validated());
        return redirect()->route('streaks.index')->with('success', 'Racha actualizada.');
    }

    public function destroy(Streak $streak)
    {
        $streak->delete();
        return redirect()->route('streaks.index')->with('success', 'Racha eliminada.');
    }
}