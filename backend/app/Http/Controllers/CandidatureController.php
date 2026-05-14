<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\OffreStage;
use App\Models\Stagiaire;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    /**
     * Show all candidatures
     */
    public function index()
    {
        return response()->json(
            Candidature::with([
                'stagiaire.user.ville',
                'offreStage.entreprise.user.ville',
                'offreStage.ville'
            ])->get()
        );
    }

    /**
     * Show one candidature
     */
    public function show(string $id)
    {
        return response()->json(
            Candidature::with([
                'stagiaire.user.ville',
                'offreStage.entreprise.user.ville',
                'offreStage.ville'
            ])->findOrFail($id)
        );
    }

    /**
     * Create new candidature
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'stagiaire_id' => 'required|exists:stagiaires,id',
            'offre_stage_id' => 'required|exists:offre_stages,id',
            'cv' => 'nullable|string|max:255',
            'lettreMotivation' => 'nullable|string',
        ]);

        $stagiaire = Stagiaire::findOrFail($data['stagiaire_id']);
        $offre = OffreStage::findOrFail($data['offre_stage_id']);

        $exists = Candidature::where('stagiaire_id', $stagiaire->id)
            ->where('offre_stage_id', $offre->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'This stagiaire already applied to this offer.'
            ], 409);
        }

        $candidature = Candidature::create([
            'stagiaire_id' => $stagiaire->id,
            'offre_stage_id' => $offre->id,
            'datePostulation' => now(),
            'cv' => $data['cv'] ?? $stagiaire->cv,
            'lettreMotivation' => $data['lettreMotivation'] ?? null,
            'statut' => 'en_attente',
        ]);

        return response()->json(
            $candidature->load([
                'stagiaire.user.ville',
                'offreStage.entreprise.user.ville',
                'offreStage.ville'
            ]),
            201
        );
    }

    /**
     * Update candidature
     */
    public function update(Request $request, string $id)
    {
        $candidature = Candidature::findOrFail($id);

        $data = $request->validate([
            'cv' => 'nullable|string|max:255',
            'lettreMotivation' => 'nullable|string',
            'statut' => 'nullable|in:en_attente,acceptee,refusee',
        ]);

        $candidature->update($data);

        return response()->json(
            $candidature->load([
                'stagiaire.user.ville',
                'offreStage.entreprise.user.ville',
                'offreStage.ville'
            ])
        );
    }

    /**
     * Accept candidature
     */
    public function accepter(string $id)
    {
        $candidature = Candidature::findOrFail($id);

        $candidature->update([
            'statut' => 'acceptee'
        ]);

        return response()->json([
            'message' => 'Candidature accepted successfully',
            'candidature' => $candidature->load([
                'stagiaire.user.ville',
                'offreStage.entreprise.user.ville',
                'offreStage.ville'
            ])
        ]);
    }

    /**
     * Refuse candidature
     */
    public function refuser(string $id)
    {
        $candidature = Candidature::findOrFail($id);

        $candidature->update([
            'statut' => 'refusee'
        ]);

        return response()->json([
            'message' => 'Candidature refused successfully',
            'candidature' => $candidature->load([
                'stagiaire.user.ville',
                'offreStage.entreprise.user.ville',
                'offreStage.ville'
            ])
        ]);
    }

    /**
     * Delete candidature
     */
    public function destroy(string $id)
    {
        $candidature = Candidature::findOrFail($id);

        $candidature->delete();

        return response()->json([
            'message' => 'Candidature deleted successfully'
        ]);
    }
}