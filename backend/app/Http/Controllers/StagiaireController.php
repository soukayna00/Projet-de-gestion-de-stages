<?php

namespace App\Http\Controllers;

use App\Models\Stagiaire;
use App\Models\User;
use Illuminate\Http\Request;

class StagiaireController extends Controller
{
    public function index()
    {
        return response()->json(
            Stagiaire::with('user.ville')->get()
        );
    }

    public function show(string $id)
    {
        return response()->json(
            Stagiaire::with('user.ville')->findOrFail($id)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id|unique:stagiaires,user_id',
            'cin' => 'nullable|string|max:255|unique:stagiaires,cin',
            'dateNaissance' => 'nullable|date',
            'cv' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'competence' => 'nullable|string|max:255',
        ]);

        $user = User::findOrFail($data['user_id']);

        if ($user->role !== 'stagiaire') {
            return response()->json([
                'message' => 'This user is not a stagiaire'
            ], 422);
        }

        $stagiaire = Stagiaire::create($data);

        return response()->json(
            $stagiaire->load('user.ville'),
            201
        );
    }

    public function update(Request $request, string $id)
    {
        $stagiaire = Stagiaire::findOrFail($id);

        $data = $request->validate([
            'cin' => 'nullable|string|max:255|unique:stagiaires,cin,' . $stagiaire->id,
            'dateNaissance' => 'nullable|date',
            'cv' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'competence' => 'nullable|string|max:255',
        ]);

        $stagiaire->update($data);

        return response()->json(
            $stagiaire->load('user.ville')
        );
    }

    public function destroy(string $id)
    {
        $stagiaire = Stagiaire::findOrFail($id);

        $stagiaire->delete();

        return response()->json([
            'message' => 'Stagiaire deleted successfully'
        ]);
    }
}