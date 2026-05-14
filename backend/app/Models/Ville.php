<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $fillable = ['nom'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // public function offres()
    // {
    //     return $this->hasMany(OffreStage::class);
    // }
}
