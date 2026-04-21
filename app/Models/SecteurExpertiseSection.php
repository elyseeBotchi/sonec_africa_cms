<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecteurExpertiseSection extends Model
{
    //
    protected $fillable = [
        'secteur_expertise_id',
        'title',
        'subtitle',
        'content',
        'section_key',
        'page_key',
    ];

    public function secteurExpertise()
    {
        return $this->belongsTo(SecteurExpertise::class);
    }
}

