<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AgregadoController;

class UserController extends Controller
{

    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $cargos = AgregadoController::cargos();
        return view('users.create', ['user' => new User, 'cargos' => $cargos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cargo' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::default()],
        ]);

        User::create([
            'name' => $request->input('name'),
            'cargo' => $request->input('cargo'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return to_route('users.index')->with('status', 'Agregado con éxito.');
    }

    public function show(User $user)
    {
    }

    public function edit(User $user)
    {
        $cargos = AgregadoController::cargos();
        return view('users.edit', ['user' => $user, 'cargos' => $cargos]);
    }
    public function update(Request $request, User $user)
    {
        if(!empty($request->input('password'))) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'cargo' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::default()],
            ]);
            $user->update([
                'name' => $request->input('name'),
                'cargo' => $request->input('cargo'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
        }else{
            $validate = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'cargo' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
            $user->update($validate);
        }

        return to_route('users.index')->with('status', 'Actualizado con éxito.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return to_route('users.index')->with('status', 'Eliminado con éxito.');
    }
}
