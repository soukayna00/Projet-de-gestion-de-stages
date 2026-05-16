<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bloque extends Model
{
    protected $fillable = [
        'admin_id',
        'user_id',
        'raison',
        'date_blocage',
        'is_active',
    ];

    protected $casts = [
        'date_blocage' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}