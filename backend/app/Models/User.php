<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'telephone',
        'id_ville',
        'image',
        'is_blocked',
        'is_validated',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_blocked' => 'boolean',
        'is_validated' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'id_ville');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function stagiaire()
    {
        return $this->hasOne(Stagiaire::class);
    }

    public function entreprise()
    {
        return $this->hasOne(Entreprise::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function signalements()
    {
        return $this->hasMany(Signalement::class, 'reporter_id');
    }

    public function signalementsRecus()
    {
        return $this->hasMany(Signalement::class, 'reported_user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function blocages()
    {
        return $this->hasMany(Bloque::class);
    }
}