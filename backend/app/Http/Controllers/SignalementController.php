<?php

namespace App\Http\Controllers;

use App\Models\Signalement;
use Illuminate\Http\Request;

class SignalementController extends Controller
{
    public function index()
    {
        return response()->json(
            Signalement::with([
                'reporter.ville',
                'reportedUser.ville',
                'commentaire.user.ville',
                'commentaire.offreStage',
                'offreStage.entreprise.user.ville',
                'offreStage.ville',
            ])->get()
        );
    }

    public function show(string $id)
    {
        return response()->json(
            Signalement::with([
                'reporter.ville',
                'reportedUser.ville',
                'commentaire.user.ville',
                'commentaire.offreStage',
                'offreStage.entreprise.user.ville',
                'offreStage.ville',
            ])->findOrFail($id)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'reporter_id' => 'required|exists:users,id',

            'reported_user_id' => 'nullable|exists:users,id',
            'commentaire_id' => 'nullable|exists:commentaires,id',
            'offre_stage_id' => 'nullable|exists:offre_stages,id',

            'raison' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if (
            empty($data['reported_user_id'])
            && empty($data['commentaire_id'])
            && empty($data['offre_stage_id'])
        ) {
            return response()->json([
                'message' => 'You must report a user, comment, or offer.'
            ], 422);
        }

        $signalement = Signalement::create([
            'reporter_id' => $data['reporter_id'],
            'reported_user_id' => $data['reported_user_id'] ?? null,
            'commentaire_id' => $data['commentaire_id'] ?? null,
            'offre_stage_id' => $data['offre_stage_id'] ?? null,
            'raison' => $data['raison'],
            'description' => $data['description'] ?? null,
            'statut' => 'en_attente',
            'date_signalement' => now(),
        ]);

        return response()->json(
            $signalement->load([
                'reporter.ville',
                'reportedUser.ville',
                'commentaire.user.ville',
                'commentaire.offreStage',
                'offreStage.entreprise.user.ville',
                'offreStage.ville',
            ]),
            201
        );
    }

    public function update(Request $request, string $id)
    {
        $signalement = Signalement::findOrFail($id);

        $data = $request->validate([
            'statut' => 'required|in:en_attente,traite,rejete',
        ]);

        $signalement->update([
            'statut' => $data['statut'],
        ]);

        return response()->json(
            $signalement->load([
                'reporter.ville',
                'reportedUser.ville',
                'commentaire.user.ville',
                'commentaire.offreStage',
                'offreStage.entreprise.user.ville',
                'offreStage.ville',
            ])
        );
    }

    public function destroy(string $id)
    {
        $signalement = Signalement::findOrFail($id);

        $signalement->delete();

        return response()->json([
            'message' => 'Signalement deleted successfully'
        ]);
    }

    public function traiter(string $id)
    {
        $signalement = Signalement::findOrFail($id);

        $signalement->update([
            'statut' => 'traite',
        ]);

        return response()->json([
            'message' => 'Signalement marked as treated',
            'signalement' => $signalement
        ]);
    }

    public function rejeter(string $id)
    {
        $signalement = Signalement::findOrFail($id);

        $signalement->update([
            'statut' => 'rejete',
        ]);

        return response()->json([
            'message' => 'Signalement rejected',
            'signalement' => $signalement
        ]);
    }
}