<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        // Redirige a la página de índice de usuarios con un mensaje de éxito
        return redirect()->route('panel.users.index')->with('success', 'Usuario creado exitosamente');
    }

    public function show(User $user)
    {
        return view('panel.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('panel.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6', // La contraseña es opcional y debe tener al menos 6 caracteres si se proporciona
            // Agrega más campos según sea necesario
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Por favor, ingrese un correo electrónico válido.',
            'email.unique' => 'El correo electrónico ya está en uso por otro usuario.',
            // Agrega más mensajes según sea necesario
        ]);

        // Actualiza los datos del usuario con los datos validados
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->filled('password') ? bcrypt($request->input('password')) : $user->password,
            // Agrega más campos según sea necesario
        ]);

        return redirect()->route('panel.users.index')->with('success', 'Usuario actualizado exitosamente');
    }

    public function updateForm($user)
    {
        $user = User::find($user);
        return view('panel.users.update', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('panel.users.index')->with('success', 'Usuario eliminado exitosamente');
    }
}
