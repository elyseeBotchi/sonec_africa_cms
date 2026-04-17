<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OffreEmploi extends Model
{
    //
    protected $table = 'offre_emplois';

    protected $fillable = [
        'title',
        'description',
        'lieu',
        'type_contrat',
        'slug',
        'departement',
        'niveau_experience',
        'salaire',
        'email_contact',
        'status',
        'date_expiration',
        'bureau_pays_id',
        'page_key',
        'section_key',
        'missions',
        'profil_recherche',
        'avantages',
        'domaine',
    ];

    protected $casts = [
        'date_expiration' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function bureauPays()
    {
        return $this->belongsTo(BureauPays::class, 'bureau_pays_id');
    }
}
