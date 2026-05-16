<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OffreStage extends Model
{
    protected $fillable = [
    'entreprise_id',
    'titre',
    'description',
    'domaine',
    'type',
    'datePublication',
    'dateDebut',
    'dateFin',
    'id_ville',
    'statut',
];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
    public function ville()
{
    return $this->belongsTo(Ville::class, 'id_ville');
}
public function candidatures()
{
    return $this->hasMany(Candidature::class);
}
public function favoris()
{
    return $this->hasMany(Favori::class);
}
public function commentaires()
{
    return $this->hasMany(Commentaire::class);
}
public function signalements()
{
    return $this->hasMany(Signalement::class);
}
}