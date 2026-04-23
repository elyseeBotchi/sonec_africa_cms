<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidatureSpontanee extends Model
{
    //
    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'cv',
        'lettre_motivation',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
