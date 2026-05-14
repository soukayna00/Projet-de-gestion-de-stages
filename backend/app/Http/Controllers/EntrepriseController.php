<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function index()
    {
        return response()->json(
            Entreprise::with('user.ville')->get()
        );
    }

    public function show(string $id)
    {
        return response()->json(
            Entreprise::with('user.ville')->findOrFail($id)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id|unique:entreprises,user_id',
            'secteur' => 'nullable|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $user = User::findOrFail($data['user_id']);

        if ($user->role !== 'entreprise') {
            return response()->json([
                'message' => 'This user is not an entreprise'
            ], 422);
        }

        $entreprise = Entreprise::create($data);

        return response()->json(
            $entreprise->load('user.ville'),
            201
        );
    }

    public function update(Request $request, string $id)
    {
        $entreprise = Entreprise::findOrFail($id);

        $data = $request->validate([
            'secteur' => 'nullable|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $entreprise->update($data);

        return response()->json(
            $entreprise->load('user.ville')
        );
    }

    public function destroy(string $id)
    {
        $entreprise = Entreprise::findOrFail($id);

        $entreprise->delete();

        return response()->json([
            'message' => 'Entreprise deleted successfully'
        ]);
    }
}