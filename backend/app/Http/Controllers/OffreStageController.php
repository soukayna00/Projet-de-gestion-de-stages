<?php

namespace App\Http\Controllers;

use App\Models\OffreStage;
use Illuminate\Http\Request;

class OffreStageController extends Controller
{
  public function index()
{
    $offres = OffreStage::with([
        'entreprise.user:id,name,email,telephone,id_ville,image',
        'entreprise.user.ville',
        'ville',

        'commentaires' => function ($query) {
            $query->latest();
        },

        'commentaires.user:id,name,email,telephone,id_ville,image,role',
        'commentaires.user.ville',
    ])
    ->withCount([
        'candidatures',
        'favoris',
        'commentaires',
    ])
    ->latest()
    ->get();

    return response()->json($offres);
}



    public function show(string $id)
{
    $offre = OffreStage::with([
        'entreprise.user.ville',
        'ville',

        'commentaires' => function ($query) {
            $query->where('is_hidden', false)
                ->latest();
        },

        'commentaires.user.ville',

        'candidatures.stagiaire.user.ville',

        'favoris.stagiaire.user.ville',
    ])
    ->withCount([
        'candidatures',
        'favoris',
        'commentaires',
        'signalements',
    ])
    ->findOrFail($id);

    return response()->json($offre);
}



    public function store(Request $request)
    {
        $data = $request->validate([
            'entreprise_id' => 'required|exists:entreprises,id',
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'domaine' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'datePublication' => 'nullable|date',
            'dateDebut' => 'nullable|date',
            'dateFin' => 'nullable|date|after_or_equal:dateDebut',
            'id_ville' => 'nullable|exists:villes,id',
            'statut' => 'nullable|string|max:255',
        ]);

        if (empty($data['datePublication'])) {
            $data['datePublication'] = now()->toDateString();
        }

        if (empty($data['statut'])) {
            $data['statut'] = 'en_attente';
        }

        $offre = OffreStage::create($data);

        return response()->json(
            $offre->load([
                'entreprise.user.ville',
                'ville'
            ]),
            201
        );
    }

    public function update(Request $request, string $id)
    {
        $offre = OffreStage::findOrFail($id);

        $data = $request->validate([
            'titre' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'domaine' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'datePublication' => 'nullable|date',
            'dateDebut' => 'nullable|date',
            'dateFin' => 'nullable|date|after_or_equal:dateDebut',
            'id_ville' => 'nullable|exists:villes,id',
            'statut' => 'nullable|string|max:255',
        ]);

        $offre->update($data);

        return response()->json(
            $offre->load([
                'entreprise.user.ville',
                'ville'
            ])
        );
    }

    public function destroy(string $id)
    {
        $offre = OffreStage::findOrFail($id);

        $offre->delete();

        return response()->json([
            'message' => 'Offre deleted successfully'
        ]);
    }
}