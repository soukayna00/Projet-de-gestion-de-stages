<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    /**
     * Show all comments
     */
    public function index()
    {
        return response()->json(
            Commentaire::with([
                'user.ville',
                'offreStage.entreprise.user.ville',
                'offreStage.ville'
            ])->latest()->get()
        );
    }

    /**
     * Show one comment
     */
    public function show(string $id)
    {
        return response()->json(
            Commentaire::with([
                'user.ville',
                'offreStage.entreprise.user.ville',
                'offreStage.ville'
            ])->findOrFail($id)
        );
    }

    /**
     * Create comment using logged-in user
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'offre_stage_id' => 'required|exists:offre_stages,id',
            'contenu' => 'required|string',
        ]);

        $commentaire = Commentaire::create([
            'user_id' => $request->user()->id,
            'offre_stage_id' => $data['offre_stage_id'],
            'contenu' => $data['contenu'],
            'dateCreation' => now(),
        ]);

        return response()->json(
            $commentaire->load([
                'user.ville',
                'offreStage.entreprise.user.ville',
                'offreStage.ville'
            ]),
            201
        );
    }

    /**
     * Update comment
     */
    public function update(Request $request, string $id)
    {
        $commentaire = Commentaire::findOrFail($id);

        if (
            $commentaire->user_id !== $request->user()->id
            && $request->user()->role !== 'admin'
        ) {
            return response()->json([
                'message' => 'You are not allowed to update this comment.'
            ], 403);
        }

        $data = $request->validate([
            'contenu' => 'required|string',
        ]);

        $commentaire->update([
            'contenu' => $data['contenu'],
        ]);

        return response()->json(
            $commentaire->load([
                'user.ville',
                'offreStage.entreprise.user.ville',
                'offreStage.ville'
            ])
        );
    }

    /**
     * Delete comment
     */
    public function destroy(Request $request, string $id)
    {
        $commentaire = Commentaire::findOrFail($id);

        if (
            $commentaire->user_id !== $request->user()->id
            && $request->user()->role !== 'admin'
        ) {
            return response()->json([
                'message' => 'You are not allowed to delete this comment.'
            ], 403);
        }

        $commentaire->delete();

        return response()->json([
            'message' => 'Commentaire deleted successfully'
        ]);
    }
}