<?php

namespace App\Http\Controllers;

use App\Models\Favori;
use App\Models\OffreStage;
use App\Models\Stagiaire;
use Illuminate\Http\Request;

class FavoriController extends Controller
{
    /**
     * Show all favoris
     */
    public function index()
    {
        return response()->json(
            Favori::with([
                'stagiaire.user.ville',
                'offreStage.entreprise.user.ville',
                'offreStage.ville'
            ])->get()
        );
    }

    /**
     * Show one favori
     */
    public function show(string $id)
    {
        return response()->json(
            Favori::with([
                'stagiaire.user.ville',
                'offreStage.entreprise.user.ville',
                'offreStage.ville'
            ])->findOrFail($id)
        );
    }

    /**
     * Add offer to favorites
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'stagiaire_id' => 'required|exists:stagiaires,id',
            'offre_stage_id' => 'required|exists:offre_stages,id',
        ]);

        $stagiaire = Stagiaire::findOrFail($data['stagiaire_id']);
        $offre = OffreStage::findOrFail($data['offre_stage_id']);

        $exists = Favori::where('stagiaire_id', $stagiaire->id)
            ->where('offre_stage_id', $offre->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'This offer is already in favorites.'
            ], 409);
        }

        $favori = Favori::create([
            'stagiaire_id' => $stagiaire->id,
            'offre_stage_id' => $offre->id,
            'dateAjout' => now(),
        ]);

        return response()->json(
            $favori->load([
                'stagiaire.user.ville',
                'offreStage.entreprise.user.ville',
                'offreStage.ville'
            ]),
            201
        );
    }

    /**
     * Update favori
     *
     * Usually favoris do not need update.
     */
    public function update(Request $request, string $id)
    {
        return response()->json([
            'message' => 'Update is not necessary for favoris.'
        ], 405);
    }

    /**
     * Remove favori
     */
    public function destroy(string $id)
    {
        $favori = Favori::findOrFail($id);

        $favori->delete();

        return response()->json([
            'message' => 'Favori deleted successfully'
        ]);
    }

    /**
     * Remove favorite by stagiaire and offre
     */
    public function removeByStagiaireAndOffre(Request $request)
    {
        $data = $request->validate([
            'stagiaire_id' => 'required|exists:stagiaires,id',
            'offre_stage_id' => 'required|exists:offre_stages,id',
        ]);

        $favori = Favori::where('stagiaire_id', $data['stagiaire_id'])
            ->where('offre_stage_id', $data['offre_stage_id'])
            ->firstOrFail();

        $favori->delete();

        return response()->json([
            'message' => 'Favori deleted successfully'
        ]);
    }
}