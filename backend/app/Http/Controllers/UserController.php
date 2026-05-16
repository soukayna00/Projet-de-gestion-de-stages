<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('ville')->get();

        return response()->json($users);
    }

    public function show(string $id)
    {
        $user = User::with('ville')->findOrFail($id);

        return response()->json($user);
    }

    public function store(Request $request)
    {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
        'role' => 'required|in:admin,stagiaire,entreprise',
        'telephone' => 'nullable|string|max:50',
        'id_ville' => 'nullable|exists:villes,id',
    ]);

    $data['password'] = Hash::make($data['password']);

    if ($data['role'] === 'admin') {
        $data['image'] = 'admin-default.png';
    } else {
        $data['image'] = strtoupper(substr($data['name'], 0, 1));
    }

    $user = User::create($data);

    return response()->json(
        $user->load('ville'),
        201
    );
    }



    public function update(Request $request, string $id)
  {
    $user = User::findOrFail($id);

    $data = $request->validate([
        'name' => 'sometimes|string|max:255',
        'email' => 'sometimes|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8',
        'role' => 'sometimes|in:admin,stagiaire,entreprise',
        'telephone' => 'nullable|string|max:50',
        'id_ville' => 'nullable|exists:villes,id',
    ]);

    if (!empty($data['password'])) {
        $data['password'] = Hash::make($data['password']);
    }

    $newRole = $data['role'] ?? $user->role;
    $newName = $data['name'] ?? $user->name;

    if ($newRole === 'admin') {
        $data['image'] = 'admin-default.png';
    } else {
        $data['image'] = strtoupper(substr($newName, 0, 1));
    }

    $user->update($data);

    return response()->json(
        $user->load('ville')
    );
}



    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

       return response()->json([
        'message' => 'User soft deleted successfully'
    ]);
    }
}