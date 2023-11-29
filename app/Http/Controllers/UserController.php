<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('panel.users.index', compact('users'));
    }

    public function create()
    {
        return view('panel.users.create');
    }

    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            // Agrega más campos según sea necesario
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Por favor, ingrese un correo electrónico válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            // Agrega más mensajes según sea necesario
        ]);

        // Crea un nuevo usuario con los datos validados
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            // Agrega más campos según sea necesario
        ]);

        $user->assignRole('playero');

        // Redirige a la página de índice de usuarios con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente');
    }


    public function show(User $user)
    {
        return view('panel.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all(); // Recuperamos todos los roles
        return view('panel.users.edit', compact('user', 'roles')); // Pasamos los roles a la vista
    }

    public function update(Request $request, User $user)
    {
    

        // Sincronizamos los roles del usuario
        $user->roles()->sync($request->roles);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente');
    }

    public function updateForm($user)
    {
        $user = User::find($user);
        return view('users.update', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente');
    }
}