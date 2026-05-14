<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $fillable = [
        'user_id',
        'offre_stage_id',
        'contenu',
        'dateCreation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offreStage()
    {
        return $this->belongsTo(OffreStage::class);
    }
    public function signalements()
{
    return $this->hasMany(Signalement::class);
}

}