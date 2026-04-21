<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecteurExpertiseChiffre extends Model
{
    //
    protected $fillable = [
        'label',
        'value',
        'description',
        'icon',
        'icon_url',
        'secteur_expertise_id',
        'section_key',
        'page_key',
    ];

    public function secteurExpertise()
    {
        return $this->belongsTo(SecteurExpertise::class);
    }
}
