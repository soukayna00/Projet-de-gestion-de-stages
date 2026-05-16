<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $fillable = [
        'stagiaire_id',
        'offre_stage_id',
        'datePostulation',
        'cv',
        'lettreMotivation',
        'statut',
    ];

    public function stagiaire()
    {
        return $this->belongsTo(Stagiaire::class);
    }

    public function offreStage()
    {
        return $this->belongsTo(OffreStage::class);
    }
}