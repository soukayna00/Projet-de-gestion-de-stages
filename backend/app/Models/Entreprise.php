<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $fillable = [
        'user_id',
        'secteur',
        'adresse',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}