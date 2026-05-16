<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    protected $fillable = [
        'user_id',
        'cin',
        'dateNaissance',
        'cv',
        'education',
        'competence',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function candidatures()
{
    return $this->hasMany(Candidature::class);
}
public function favoris()
{
    return $this->hasMany(Favori::class);
}
}