<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signalement extends Model
{
    protected $fillable = [
        'reporter_id',
        'reported_user_id',
        'commentaire_id',
        'offre_stage_id',
        'raison',
        'description',
        'statut',
        'date_signalement',
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'reported_user_id');
    }

    public function commentaire()
    {
        return $this->belongsTo(Commentaire::class);
    }

    public function offreStage()
    {
        return $this->belongsTo(OffreStage::class);
    }
}